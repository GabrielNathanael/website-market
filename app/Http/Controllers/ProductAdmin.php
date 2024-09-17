<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $selectedCategory = request('category');

        // Filter products based on the selected category
        if ($selectedCategory) {
            $productadmin = Product::where('category_id', $selectedCategory)->paginate(5);
        } else {
            $productadmin = Product::paginate(5);
        }

        $title="Daftar Produk";
        //$productadmin = Product::paginate(5);
        //$productadmin = Product::where('category_id', 1)->paginate(5);

        $categories = Category::all();
        return view('backpage.productadmin',compact('title','productadmin','categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories=Category::all();
        return view('backpage.create', compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'required',
            'price' => 'required',
            'stock' => 'required',
        
        ]);

        $imageName = time() . '.' . $request->image->extension();
        
        if ($request->file('image')) {
            $validate['image'] =  $request->image->storeAs('images', $imageName, 'public');
        }

        Product::create($validate);
        return redirect()->route('productadmin.index')->with('success', 'Berhasil dimasukkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=Category::all();
        $product = Product::find($id);
        return view('backpage.edit', compact("categories","product"));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        
            'price' => 'required',
            'stock' => 'required',
        ]);

        $product = Product::findOrFail($id); 

        // check if cover is uploaded   
        if ($request->file('image')) {
            Storage::disk('public')->delete($product->image);
            $imageName = time() . '.' . $request->image->extension();
            $validate['image'] =  $request->image->storeAs('images', $imageName, 'public');
        }
        

        $product->update($validate);
        return redirect()->route('productadmin.index')->with('success', 'Berhasil diedit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        Storage::disk('public')->delete($product->image);

        $product->delete();
        return redirect()->route('productadmin.index')->with('success', 'Berhasil dihapus');
    }

    public function search(Request $request)
    {
        // set title
        $title = "Product List";
        // get all products
        $productadmin = Product::where('name', 'like', '%' . $request->search . '%')->paginate(5);

        $categories = Category::all();
        // return view with all variable
        return view('backpage.productadmin', compact('title', 'productadmin', 'categories'));
    }
}
