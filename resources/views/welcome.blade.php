<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point of Sales - Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menambahkan padding dan margin untuk responsivitas */
        .hero {
            background: #007bff;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-header {
            background-color: #007bff;
        }
        footer {
            background-color: #343a40;
        }
    </style>
</head>
<body>
    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">POS Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Selamat Datang dan Selamat Bertugas</h1>
            <p class="lead">Sistem manajemen penjualan yang mudah digunakan untuk bisnis kamu.</p>
            <a href="#features" class="btn btn-light btn-lg">Pelajari Lebih Lanjut</a>
        </div>
    </section>
    

    <!-- Fitur Section -->
    <section id="features" class="py-5" >
        <div class="container text-center">
            <h2>Fitur Unggulan</h2>
            <div class="row mt-4">
                <!-- Feature 1 -->
                <div class="col-sm-12 col-md-4 mb-4">
                  <div class="card shadow">
                      <div class="card-body">
                          <h5 class="card-title">Pengelolaan Barang</h5>
                          <p class="card-text">Kelola barang dengan mudah, tambah, edit, dan hapus barang yang ada.</p>
                          <a href="{{ route('frontend.product') }}" class="btn btn-primary">Kelola Barang</a>
                      </div>
                  </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-sm-12 col-md-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Rekap Penjualan</h5>
                            <p class="card-text">Unduh rekap penjualan dengan format Excel untuk analisis lebih lanjut.</p>
                            <a href="{{ route('frontend.transaction') }}" class="btn btn-primary">Melihat Riwayat transaksi</a>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-sm-12 col-md-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Transaksi Cepat</h5>
                            <p class="card-text">Proses transaksi dengan cepat dan mudah untuk meningkatkan efisiensi bisnis.</p>
                            <a href="{{ route('frontend.sale') }}" class="btn btn-primary">Transaksi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="about" class="bg-light py-5">
        <div class="container text-center">
            <h2>Tentang Kami</h2>
            <p class="lead">Kami adalah tim pengembang yang ingin memberikan solusi manajemen penjualan yang mudah digunakan oleh bisnis kecil hingga besar.</p>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2>Kontak Kami</h2>
            <p>Jika kamu membutuhkan bantuan atau ingin berdiskusi, hubungi kami di bawah ini!</p>
            <p>Email: <a href="mailto:support@posweb.com">support@posweb.com</a></p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Point of Sales | Semua hak cipta dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
