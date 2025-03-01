@extends('layouts.admin')

@section('content')
<meta http-equiv="refresh" content="60">
<div class="pl-64 min-h-screen container mx-auto mt-5 p-5"> {{-- Gunakan pl-64 biar gak ketutupan sidebar --}}
    <h1 class="mb-6 text-center text-3xl font-bold text-blue-600">Rekap Pendapatan Harian</h1>

    <!-- Tombol Download Excel (Hanya untuk Admin) -->
    @if(auth()->user()->role === 'admin')
        <div class="mb-3">
            <a href="{{ route('export.transaksi') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                ⬇️ Download Excel
            </a>
        </div>
    @endif

    <!-- Form Pencarian -->
    <form action="{{ route('rekap') }}" method="GET" class="mb-4 flex flex-wrap gap-2">
        <input type="text" name="nama_barang" placeholder="Cari Nama Barang"
            class="border p-2 rounded-md flex-1 min-w-[150px]" value="{{ request('nama_barang') }}">

        <input type="date" name="tanggal" class="border p-2 rounded-md flex-1 min-w-[150px]"
            value="{{ request('tanggal') }}">

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Cari</button>
    </form>

    <!-- Total Keseluruhan -->
    <div class="bg-white shadow-md rounded-lg text-center p-5">
        <div class="bg-green-600 text-white py-3 rounded-t-lg">
            <h3 class="text-lg font-semibold">Total Pendapatan Keseluruhan</h3>
        </div>
        <div class="py-5">
            <h2 class="text-2xl text-green-600 font-bold">Rp {{ number_format($totalKeseluruhan, 2, ',', '.') }}</h2>
        </div>
    </div>

    <!-- Tabel Rekap -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
        <div class="bg-blue-600 text-white text-center py-3">
            <h3 class="text-lg font-semibold">Rekap Pendapatan Harian</h3>
        </div>
        <div class="p-5 overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-center">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Barang</th>
                        <th class="border border-gray-300 px-4 py-2">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekap as $transaction)
                        <tr class="odd:bg-gray-100 even:bg-white">
                            <td class="border border-gray-300 px-4 py-2">
                                {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $transaction->product->name ?? 'N/A' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-green-600 font-semibold">
                                Rp {{ number_format($transaction->total, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
