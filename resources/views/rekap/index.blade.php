@extends('layouts.app')

@section('content')
<meta http-equiv="refresh" content="60">
<div class="container">
    <h1 class="my-4">Rekap Pendapatan Harian</h1>

    <!-- Tabel Rekap -->
    <h3>Rekap Pendapatan Harian</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekap as $report)
                <tr>
                    <!-- Format tanggal menggunakan Carbon untuk format yang lebih mudah -->
                    <td>{{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}</td> <!-- Mengubah format tanggal -->
                    <td>Rp {{ number_format($report->total_pendapatan, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Pendapatan Keseluruhan</h3>
    <p>Rp {{ number_format($totalKeseluruhan, 2, ',', '.') }}</p>
</div>
@endsection



