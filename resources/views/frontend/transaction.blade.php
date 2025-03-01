<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - POS Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .card-custom {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <section id="transactions" class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Riwayat Transaksi</h2>
                <p class="text-muted">Daftar transaksi yang telah dilakukan</p>
            </div>
            
            <div class="d-flex justify-content-between mb-4">
                <a class="btn btn-primary" href="{{ route('frontend.rekap') }}">
                    📈 Rekap Harian
                </a>

                
            <form action="{{ route('frontend.transaction') }}" method="GET" class=" d-flex gap-2">
                <input type="text" name="nama_barang" placeholder="Cari Nama Barang"
                    class="form-control" value="{{ request('nama_barang') }}">
                
                <input type="date" name="tanggal" class="form-control"
                    value="{{ request('tanggal') }}">
                
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
                
                <a class="btn btn-secondary" href="{{ route('welcome') }}">
                    📦 Kembali ke Dashboard
                </a>
            </div>


            <div class="card-custom">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $index => $transaction)
                                <tr>
                                    <td>{{ $transactions->firstItem() + $index }}</td>
                                    <td>{{ $transaction->product->name ?? 'N/A' }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted">Tidak ada transaksi ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>                
                    </table>
                </div>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{ $transactions->links() }}
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
