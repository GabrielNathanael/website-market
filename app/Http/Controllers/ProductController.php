<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        
        return view('frontpage.main');
    }
    
    public function product(){
        return view('frontpage.product');
    }

    public function productDesc(){
        return view('frontpage.productDesc');
    }

    public function cart(){
        return view('frontpage.cart');
    }
}
