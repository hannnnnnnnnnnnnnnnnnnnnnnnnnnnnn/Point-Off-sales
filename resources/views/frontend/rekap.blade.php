<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60">
    <title>Rekap Pendapatan Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .total-card {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .total-card h4, .total-card p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center text-primary fw-bold">Rekap Pendapatan Harian</h1>
        
        <!-- Tombol Kembali -->
        <div class="text-left mb-4">
            <a href="{{ route('frontend.transaction') }}" class="btn btn-dark shadow">⬅ Kembali ke Riwayat</a>
        </div>
        
        <!-- Card Total Pendapatan -->
        <div class="total-card mb-4">
            <h4><i class="bi bi-cash-stack"></i> Total Pendapatan Keseluruhan</h4>
            <p class="fs-3">Rp {{ number_format($totalKeseluruhan, 2, ',', '.') }}</p>
        </div>

        <!-- Tabel Rekap Harian -->
        <div class="row row-cols-1 row-cols-md-3 g-4" id="rekap-container">
            @foreach($rekap as $report)
                <div class="col">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0">📅 {{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}</h5>
                        </div>
                        <div class="card-body text-center">
                            <p class="fs-5 fw-semibold text-dark">💰 Rp {{ number_format($report->total_pendapatan, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        setInterval(function() {
            $.ajax({
                url: '{{ route("rekap") }}',
                type: 'GET',
                success: function(response) {
                    $('#rekap-container').html(response);
                },
                error: function() {
                    alert("Gagal memuat data!");
                }
            });
        }, 60000); 
    </script>
</body>
</html>