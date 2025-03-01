<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .btn-custom {
            border-radius: 8px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .modal-body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-primary text-center">📦 Daftar Produk</h2>

        <form method="GET" action="{{ route('frontend.product') }}" class="mb-4 flex items-center space-x-2">
            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                class="border border-gray-300 p-2 rounded-lg w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="text-dark px-4 py-2 rounded-lg hover:bg-blue-700 transition-all">
                    🔍 Cari
                </button>                
        </form>
        
        
        
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('welcome') }}" class="btn btn-secondary btn-custom">
                ⬅️ Kembali ke Halaman Utama
            </a>
        </div>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $product->name }}</h5>
                            <p class="card-text">💰 Harga: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="card-text">📦 Stok: {{ $product->stock }}</p>
                            <button type="button" class="btn btn-primary btn-custom w-100" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                                ✏️ Kelola Produk
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Produk -->
                <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="editProductModalLabel{{ $product->id }}">✏️ Edit Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('products.update', $product) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="isFrontend" value="true">

                                    <div class="mb-3">
                                        <label for="name{{ $product->id }}" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" id="name{{ $product->id }}" name="name" value="{{ $product->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price{{ $product->id }}" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="price{{ $product->id }}" name="price" value="{{ $product->price }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock{{ $product->id }}" class="form-label">Stok</label>
                                        <input type="number" class="form-control" id="stock{{ $product->id }}" name="stock" value="{{ $product->stock }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">✅ Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- SweetAlert2 Script -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = '{{ route('frontend.product') }}';
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
