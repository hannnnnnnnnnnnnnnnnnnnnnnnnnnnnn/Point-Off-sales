@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow-lg rounded-lg mt-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Produk</h2>
    
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Nama Produk</label>
            <input type="text" name="name" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-gray-700 font-medium">Stok</label>
            <input type="number" name="stock" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" min="0" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium">Harga</label>
            <input type="number" name="price" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" min="0" required>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Simpan</button>
            <a href="{{ route('products.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
