<x-admin-layout>
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="w-full text-3xl text-black pb-6">Forms</h1>
    
            <div class="flex flex-wrap">
                <div class="w-full lg:w-4/5 my-6 pr-0 lg:pr-2">
                    <p class="text-xl pb-6 flex items-center">
                        <i class="fas fa-list mr-3"></i> Input Produk
                    </p>
                    <div class="leading-loose">
                        <form method="post" action="{{ route('productadmin.update', $product->id) }}" class="p-10 mb-36 bg-white rounded shadow-xl" enctype="multipart/form-data">
                            @csrf
                            @method("put")
                            <div class="">
                                <label class="block text-sm text-gray-600" for="name">Nama</label>
                                <input value="{{$product->name}}"class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text" required="" placeholder="Nama Produk" >
                                @error('name')
                                    {{$message}}
                                @enderror
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="name">Deskripsi</label>
                                <input value="{{$product->description}}" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="description" name="description" type="text" required="" placeholder="Deskripsi Produk" >
                                @error('description')
                                    {{$message}}
                                @enderror
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="name">Harga</label>
                                <input value="{{$product->price}}" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="price" name="price" type="text" required="" placeholder="Harga Produk" >
                                @error('price')
                                {{$message}}
                            @enderror
                            </div>
                        
                            <div>
                                <label class="block text-sm text-gray-600" for="name">Kategori</label>
                                    <select class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="category_id">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                      @endforeach
                                    </select>
                                    @error('category_id')
                                    {{$message}}
                                @enderror
                            </div>
                            <div>
                                <img class="my-6" src="{{ asset('storage/' . $product->image) }}" alt="" width="200" class="rounded">
                                <label for="image">Gambar Produk</label><br>
                                <input type="file"  name="image" multiple />
                                @error('image')
                                {{$message}}
                            @enderror
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="name">Stok</label>
                                <input value="{{$product->stock}}" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="stock" name="stock" type="text" required="" placeholder="Stok Produk" >
                                @error('stock')
                                {{$message}}
                            @enderror
                            </div>
                            <div class="mt-6">
                                <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </x-admin-layout>