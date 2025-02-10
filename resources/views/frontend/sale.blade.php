<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Transaksi Penjualan</h2>

    <h3>Daftar Produk</h3>

    <a href="{{ route('welcome') }}" class="btn btn-secondary m-3">Kembali ke Halaman Utama</a>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Stok: {{ $product->stock }}</p>
                    <p class="card-text">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <button class="btn btn-primary add-to-transaction" 
                        data-bs-toggle="modal" 
                        data-bs-target="#confirmModal" 
                        data-product-id="{{ $product->id }}" 
                        data-product-name="{{ $product->name }}" 
                        data-product-price="{{ $product->price }}" 
                        data-product-stock="{{ $product->stock }}">
                        Tambah ke Transaksi
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Form untuk transaksi -->
<form id="transactionForm" action="{{ route('sales.store') }}" method="POST">
    @csrf
    <input type="hidden" name="isFrontend" value="true"> <!-- Tambahkan isFrontend -->
    <input type="hidden" name="product_id[]" id="hidden-product-id">
    <input type="hidden" name="quantity[]" id="hidden-quantity">
</form>

<!-- Modal Konfirmasi Transaksi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Produk:</strong> <span id="modal-product-name"></span></p>
                <p><strong>Harga Satuan:</strong> Rp <span id="modal-product-price"></span></p>
                <p><strong>Stok Tersedia:</strong> <span id="modal-product-stock"></span></p>
                <label for="modal-quantity">Jumlah:</label>
                <input type="number" id="modal-quantity" class="form-control" min="1">
                <p class="mt-2"><strong>Total Harga:</strong> Rp <span id="modal-total"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmTransaction" class="btn btn-primary">Ya, Tambahkan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(function() {
        let selectedProductId, selectedStock, productPrice;

        // Open modal and setup values
        $('#confirmModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const productName = button.data('product-name');
            productPrice = button.data('product-price');
            selectedProductId = button.data('product-id');
            selectedStock = button.data('product-stock');

            $('#modal-product-name').text(productName);
            $('#modal-product-price').text(new Intl.NumberFormat('id-ID').format(productPrice));
            $('#modal-product-stock').text(selectedStock);
            $('#modal-total').text("0");
            $('#modal-quantity').val('').attr('max', selectedStock);
        });

        // Update total price on quantity change
        $('#modal-quantity').on('input', function() {
            const quantity = Math.min(Math.max($(this).val() || 0, 1), selectedStock);
            $(this).val(quantity);
            $('#modal-total').text(new Intl.NumberFormat('id-ID').format(quantity * productPrice));
        });

        // Handle confirm transaction
        $('#confirmTransaction').on('click', function() {
            const quantity = $('#modal-quantity').val();

            if (quantity < 1 || quantity > selectedStock) {
                Swal.fire({
                    icon: 'error',
                    title: 'Jumlah Tidak Valid!',
                    text: 'Jumlah yang dimasukkan melebihi stok atau kurang dari 1.',
                    confirmButtonText: 'OK',
                });
                return;
            }

            $('#hidden-product-id').val(selectedProductId);
            $('#hidden-quantity').val(quantity);

            // Tutup modal sebelum submit
            $('#confirmModal').modal('hide');

            // Tampilkan notifikasi sukses LANGSUNG
            Swal.fire({
                icon: 'success',
                title: 'Produk Ditambahkan!',
                text: 'Produk berhasil ditambahkan ke transaksi.',
                showConfirmButton: false,
                timer: 2000
            });

            // Submit form setelah notifikasi muncul
            setTimeout(() => {
                $('#transactionForm').submit();
            }, 1000); 
        });
    });
</script>
</body>
</html>
