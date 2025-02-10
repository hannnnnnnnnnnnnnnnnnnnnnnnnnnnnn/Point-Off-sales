@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">📜 Riwayat Transaksi</h2>

    @if($transactions->isEmpty())
        <div class="alert alert-warning">Belum ada transaksi yang tercatat.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->product->name ?? '❌ Tidak Ditemukan' }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>Rp {{ number_format($transaction->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        <td>{{ $transaction->formatted_date ?? '-' }}</td>
                        <td>{{ $transaction->formatted_day ?? '-' }}</td>
                        <td>{{ $transaction->year ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $transactions->links() }} <!-- Pagination Links -->
        </div>
    @endif
</div>
@endsection
