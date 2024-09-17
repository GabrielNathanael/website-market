<x-admin-layout>
    
    @if (session()->has('success')) 
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
    </div>
  @endif
  <div class="">
    <form action="{{ route('productadmin.search') }}" method="POST">
      @csrf
      <div class = "mt-4">
        <div class="relative">
            <input type="search" class="form-control block w-3/5 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="search" placeholder="search..." name="search" autocomplete="off">
            <button type="submit" class="btn btn-primary text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="right: 11cm;">Search</button>
        </div>
      </div>
      
    </form><div class="max-w-md mx-auto mt-5">
    
</div>

  </div>

  <div class="mb-3">
    <label for="categoryFilter" class="form-label block text-sm font-semibold text-gray-600 mb-1">Filter by Category</label>
    <select class="form-select  w-3/5 px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500" id="categoryFilter" name="categoryFilter">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <button class="btn btn-primary ml-2 px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800 focus:outline-none focus:bg-blue-600" id="applyFilter">Apply Filter</button>
</div>
<div>
    <h1>{{$title}}</h1>

</div>
    <table id="myTable" class="table-auto pb-2 w-5/6 bg-white shadow-lg rounded-lg border border-gray-300 ">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b-2 border-gray-300 border-r-2 border-gray-300">Nama</th>
                <th class=" px-6 py-3 border-b-2 border-gray-300 border-r-2 border-gray-300">Deskripsi</th>
                <th class=" px-6 py-3 border-b-2 border-gray-300 border-r-2 border-gray-300">Kategori</th>
                <th class=" px-6 py-3 border-b-2 border-gray-300 border-r-2 border-gray-300">Gambar</th>
                <th class="px-8 py-3 border-b-2 border-gray-300 border-r-2 border-gray-300">Harga</th>
                <th class=" px-8 py-3 border-b-2 border-gray-300 border-r-2 border-gray-300">Stok</th>
                <th class=" px-6 py-3 border-b-2 border-gray-300 border-r-2 border-gray-300">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productadmin as $item)
            <tr>
                <td class=" border border-r-2 border-b-2 px-6 py-4 ">{{ $item->name }}</td>
                <td class=" border border-r-2 border-b-2 px-6 py-4 ">{{ $item->description }}</td>
                <td class=" border border-r-2 border-b-2 px-6 py-4 ">{{ $item->category->name }}</td>
                <td class=" border border-r-2 border-b-2 px-6 py-4 flex justify-center"><img src="{{ asset('storage/' . $item->image) }}" alt="" width="200" class="rounded"></td>
                <td class=" border border-r-2 border-b-2 px-6 py-4 ">{{ $item->price }}</td>
                <td class=" border border-r-2 border-b-2 px-6 py-4 ">{{ $item->stock }}</td>
                <td class=" border border-r-2 border-b-2 px-6 py-4 ">
                    <a class="bg-green-500 hover:bg-green-700 text-white text-center font-bold py-2 px-4 rounded w-full block" href="{{ route('productadmin.edit',$item->id) }}">Edit</a>
                    <form action="{{ route('productadmin.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="confirmDelete('{{ route('productadmin.destroy', $item->id) }}')" class="mt-6 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">Hapus</button>
                  </form></td>
            </tr>
            @endforeach
        </tbody>
       
    </table>
    <div class="w-5/6 mt-2">
        {{$productadmin->links()}}
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add an event listener to the "Apply Filter" button
            document.getElementById('applyFilter').addEventListener('click', function () {
                // Get the selected category ID
                var categoryId = document.getElementById('categoryFilter').value;
      
                // Redirect to the current page with the selected category as a query parameter
                window.location.href = window.location.pathname + '?category=' + categoryId;
            });
        });
      </script>
      <script>
        function confirmDelete(deleteUrl) {
            if (window.confirm('Are you sure you want to delete this item?')) {
                // If the user confirms, submit the form with the delete action
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                form.style.display = 'none';
    
                var csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
    
                var methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
    
                form.appendChild(csrfToken);
                form.appendChild(methodField);
    
                document.body.appendChild(form);
    
                form.submit();
            } else {
                // If the user cancels, do nothing
            }
        }
    </script>
</x-admin-layout>