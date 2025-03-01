@extends('layouts.admin') {{-- Sesuaikan dengan layout yang digunakan --}}

@section('content')
<div class="flex ml-64 justify-center items-center min-h-screen bg-gradient-to-r from-blue-500 to-purple-600 ">
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-3xl text-center p-8 mx-auto flex items-center justify-center flex-col">
        <h2 class="text-4xl font-extrabold text-blue-700">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-gray-600 mt-2 text-lg">Anda berada di halaman admin. Kelola sistem dengan mudah dan efisien.</p>
        <div class="mt-6 border-t border-gray-300"></div>

        {{-- Statistik Singkat --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-blue-500 p-6 rounded-xl shadow-lg flex flex-col items-center justify-center transition transform hover:scale-105">
                <div class="bg-white p-4 rounded-full text-blue-500 mb-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m4 18v-8"></path>
                    </svg>
                </div>
                <div class="text-center text-white">
                    <h3 class="text-lg font-semibold">Total Produk</h3>
                    <p class="text-2xl font-bold">{{ $totalProducts ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-green-500 p-6 rounded-xl shadow-lg flex flex-col items-center justify-center transition transform hover:scale-105">
                <div class="bg-white p-4 rounded-full text-green-500 mb-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a4 4 0 00-8 0v2m8 0a4 4 0 00-8 0m8 0h3m-3 0H7m8 0V7a4 4 0 00-8 0m8 0V7a4 4 0 00-8 0"></path>
                    </svg>
                </div>
                <div class="text-center text-white">
                    <h3 class="text-lg font-semibold">Total Transaksi</h3>
                    <p class="text-2xl font-bold">{{ $totalTransactions ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-yellow-500 p-6 rounded-xl shadow-lg flex flex-col items-center justify-center transition transform hover:scale-105">
                <div class="bg-white p-4 rounded-full text-yellow-500 mb-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m0 0H9m3 0a9 9 0 110-18 9 9 0 110 18z"></path>
                    </svg>
                </div>
                <div class="text-center text-white">
                    <h3 class="text-lg font-semibold">Pendapatan</h3>
                    <p class="text-2xl font-bold">Rp{{ number_format($totalKeseluruhan, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="mt-8 text-gray-500 text-sm">
            &copy; {{ date('Y') }} Sistem Point of Sales | Dibuat dengan ❤️ oleh Tim Anda Farhan | Syahrul | Rezal | Sahril
        </div>
    </div>
</div>
@endsection
