<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60">
    <title>Rekap Pendapatan Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="my-4">Rekap Pendapatan Harian</h1>
        <a href="{{ route('frontend.transaction') }}" class="btn btn-secondary mb-3">Kembali Ke riwayat</a>
        <!-- Card untuk Total Pendapatan Keseluruhan di bagian atas -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h4 class="card-title mb-0">Total Pendapatan Keseluruhan</h4>
            </div>
            <div class="card-body">
                <p class="card-text">Rp {{ number_format($totalKeseluruhan, 2, ',', '.') }}</p>
            </div>
        </div>

        <!-- Tabel untuk menampilkan Rekap -->
        <div class="row row-cols-1 row-cols-md-3 g-4" id="rekap-container">
            @foreach($rekap as $report)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">Tanggal: {{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Total Pendapatan: Rp {{ number_format($report->total_pendapatan, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        setInterval(function() {
            // Mengambil data terbaru dari backend
            $.ajax({
                url: '{{ route("rekap") }}',  // Ganti dengan route yang sesuai
                type: 'GET',
                success: function(response) {
                    // Update data yang ada di frontend
                    $('#rekap-container').html(response);
                },
                error: function() {
                    alert("Gagal memuat data!");
                }
            });
        }, 60000); // Mengambil data setiap 1 menit
    </script>
</body>
</html>
