@extends('layouts.admin')

@section('content')
<div class="ml-64 max-w-5xl mx-auto px-6 py-8">  {{-- Tambahkan ml-64 agar konten tidak ketimpa sidebar --}}
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Daftar Produk</h2>
    
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
        <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-5 py-2 rounded-md shadow-md hover:bg-blue-700 transition-all duration-300">
            Tambah Produk
        </a>
        <form method="GET" action="{{ route('products.index') }}" class="mt-4 md:mt-0">
            <div class="flex items-center border border-gray-300 rounded-md overflow-hidden">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}" class="p-2 m-2 w-full md:w-64 outline-none">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 transition-all duration-300">Cari</button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="mt-4 p-3 bg-green-500 text-white rounded-md shadow-md animate-fade-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Nama Produk</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-100 transition-all duration-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 flex justify-center space-x-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-yellow-600 transition-all duration-300">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-700 transition-all duration-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
