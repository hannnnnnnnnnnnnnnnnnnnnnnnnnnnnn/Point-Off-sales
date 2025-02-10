@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaksi Penjualan</h2>

    {{-- Tabel Produk & Stok --}}
    <h3>Daftar Produk</h3>
    <form action="{{ route('sales.store') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Stok</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $product->name }}
                            <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                        </td>
                        <td id="stok{{ $product->id }}">{{ $product->stock }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <input type="number" name="quantity[]" id="quantity{{ $product->id }}" class="form-control"
                                data-harga="{{ $product->price }}" data-stok="{{ $product->stock }}"
                                data-target="total{{ $product->id }}" min="1" max="{{ $product->stock }}" placeholder="0">
                        </td>
                        <td>
                            <input type="text" id="total{{ $product->id }}" class="form-control" value="Rp 0,00" readonly>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success btn-sm">Tambah</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    
</div>

{{-- Script untuk menghitung total harga --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let inputs = document.querySelectorAll('.form-control');
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
