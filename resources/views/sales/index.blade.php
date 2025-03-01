@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5 p-5">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Transaksi Penjualan</h2>

    <!-- Tabel Produk & Stok -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden p-5">
        <h3 class="text-xl font-semibold mb-4">Daftar Produk</h3>
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 text-center">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">#</th>
                            <th class="border border-gray-300 px-4 py-2">Produk</th>
                            <th class="border border-gray-300 px-4 py-2">Stok</th>
                            <th class="border border-gray-300 px-4 py-2">Harga Satuan</th>
                            <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                            <th class="border border-gray-300 px-4 py-2">Total Harga</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="odd:bg-gray-100 even:bg-white">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->name }}
                                    <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                                </td>
                                <td id="stok{{ $product->id }}" class="border border-gray-300 px-4 py-2">{{ $product->stock }}</td>
                                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <input type="number" name="quantity[]" id="quantity{{ $product->id }}" 
                                        class="form-input border border-gray-300 px-2 py-1 rounded w-20 text-center"
                                        data-harga="{{ $product->price }}" data-stok="{{ $product->stock }}"
                                        data-target="total{{ $product->id }}" min="1" max="{{ $product->stock }}" 
                                        placeholder="0">
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <input type="text" id="total{{ $product->id }}" 
                                        class="form-input border border-gray-300 px-2 py-1 rounded w-32 text-center bg-gray-100" 
                                        value="Rp 0,00" readonly>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Tambah</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk menghitung total harga -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('input', function () {
                let hargaSatuan = parseFloat(this.dataset.harga);
                let stokTersedia = parseInt(this.dataset.stok);
                let jumlah = parseInt(this.value) || 0;
    
                // Pastikan jumlah tidak melebihi stok
                if (jumlah > stokTersedia) {
                    this.value = stokTersedia;
                    jumlah = stokTersedia;
                }
    
                let total = hargaSatuan * jumlah;
                let targetId = this.dataset.target;
                document.getElementById(targetId).value = "Rp " + total.toLocaleString('id-ID', { minimumFractionDigits: 2 });
            });
        });
    });
</script>
@endsection