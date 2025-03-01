@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-4xl font-bold text-center text-blue-700 mb-8">Transaksi Penjualan</h2>

    <!-- Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('welcome') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all shadow-md">
            ⬅ Kembali ke Pengelolaan Barang
        </a>
    </div>

    <!-- Daftar Produk dalam Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
        <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-2xl transition-all">
            <h3 class="text-2xl font-semibold mb-2">{{ $product->name }}</h3>
            <p class="text-gray-600">Stok: <span id="stok{{ $product->id }}" class="font-bold">{{ $product->stock }}</span></p>
            <p class="text-gray-600">Harga: <span class="text-green-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span></p>
            
            <input type="number" name="quantity" id="quantity{{ $product->id }}"
                class="form-input border border-gray-300 px-3 py-2 rounded-md w-full mt-3 text-center focus:ring-2 focus:ring-blue-400"
                data-harga="{{ $product->price }}" data-stok="{{ $product->stock }}"
                data-target="total{{ $product->id }}" min="1" max="{{ $product->stock }}"
                placeholder="Masukkan jumlah">

            <p class="mt-3 font-semibold">Total Harga: <span id="total{{ $product->id }}" class="text-blue-600">Rp 0,00</span></p>

            <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 w-full mt-4 transition-all shadow-md add-to-transaction" 
                data-product-id="{{ $product->id }}">
                + Tambah ke Transaksi
            </button>
        </div>
        @endforeach
    </div>
</div>

<!-- Form untuk transaksi -->
<form id="transactionForm" action="{{ route('sales.store') }}" method="POST" hidden>
    @csrf
    <input type="hidden" name="product_id[]" id="hidden-product-id">
    <input type="hidden" name="quantity[]" id="hidden-quantity">
</form>

<!-- Tambahkan SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script untuk mengatur total harga dan submit transaksi -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input[name="quantity"]').forEach(input => {
            input.addEventListener('input', function () {
                let hargaSatuan = parseFloat(this.dataset.harga);
                let stokTersedia = parseInt(this.dataset.stok);
                let jumlah = parseInt(this.value) || 0;

                if (jumlah > stokTersedia) {
                    this.value = stokTersedia;
                    jumlah = stokTersedia;
                }

                let total = hargaSatuan * jumlah;
                document.getElementById(this.dataset.target).textContent = "Rp " + total.toLocaleString('id-ID', { minimumFractionDigits: 2 });
            });
        });

        document.querySelectorAll('.add-to-transaction').forEach(button => {
            button.addEventListener('click', function () {
                let productId = this.dataset.productId;
                let quantityInput = document.getElementById("quantity" + productId);
                let quantity = parseInt(quantityInput.value) || 0;
                let maxStock = parseInt(quantityInput.dataset.stok);

                if (quantity < 1 || quantity > maxStock) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Jumlah Tidak Valid!',
                        text: 'Jumlah yang dimasukkan melebihi stok atau kurang dari 1.',
                        confirmButtonText: 'OK',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Konfirmasi Transaksi',
                    text: 'Apakah Anda yakin ingin menambahkan produk ini ke transaksi?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tambahkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('hidden-product-id').value = productId;
                        document.getElementById('hidden-quantity').value = quantity;
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Produk Ditambahkan!',
                            text: 'Produk berhasil ditambahkan ke transaksi.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            document.getElementById('transactionForm').submit();
                        }, 1000);
                    }
                });
            });
        });
    });
</script>
@endsection
