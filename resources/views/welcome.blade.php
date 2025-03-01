@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section id="home" class="bg-blue-600 text-white text-center py-20">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold">Selamat Datang dan Selamat Bertugas {{ Auth::user()->name }}! 👋</h1>
        <p class="text-lg mt-4">Sistem manajemen penjualan yang mudah digunakan untuk bisnis kamu.</p>
        <a href="#features" class="mt-6 inline-block bg-white text-blue-600 font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-gray-200 transition">Pelajari Lebih Lanjut</a>
    </div>
</section>

<!-- Fitur Section -->
<section id="features" class="py-16 bg-gray-100">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-gray-800">Fitur Unggulan</h2>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            
            <!-- Feature 1 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-xl font-semibold text-gray-800">Pengelolaan Barang</h5>
                <p class="text-gray-600 mt-2">Kelola barang dengan mudah, tambah, edit, dan hapus barang yang ada.</p>
                <a href="{{ route('frontend.product') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Kelola Barang</a>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-xl font-semibold text-gray-800">Rekap Penjualan</h5>
                <p class="text-gray-600 mt-2">Unduh rekap penjualan dengan format Excel untuk analisis lebih lanjut.</p>
                <a href="{{ route('frontend.transaction') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Melihat Riwayat Transaksi</a>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h5 class="text-xl font-semibold text-gray-800">Transaksi Cepat</h5>
                <p class="text-gray-600 mt-2">Proses transaksi dengan cepat dan mudah untuk meningkatkan efisiensi bisnis.</p>
                <a href="{{ route('frontend.sale') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Transaksi</a>
            </div>

        </div>
    </div>
</section>

<!-- Tentang Kami Section -->
<section id="about" class="py-16 bg-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-gray-800">Tentang Kami</h2>
        <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Kami adalah tim pengembang yang ingin memberikan solusi manajemen penjualan yang mudah digunakan oleh bisnis kecil hingga besar.</p>
    </div>
</section>

<!-- Kontak Section -->
<section id="contact" class="py-16 bg-gray-100">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-gray-800">Kontak Kami</h2>
        <p class="text-gray-600 mt-4">Jika kamu membutuhkan bantuan atau ingin berdiskusi, hubungi kami di bawah ini!</p>
        <p class="text-blue-600 font-semibold mt-2">Email: <a href="mailto:farhanrobani30@gmail.com" class="underline">farhanrobani30</a></p>
    </div>
</section>

<!-- Footer -->
<footer class="bg-blue-600 text-white text-center py-6">
    <p>&copy; 2025 Point of Sales | Dibuat dengan ❤️ oleh Tim  Farhan | Syahrul | Rezal | Sahril </p>
</footer>

@endsection
