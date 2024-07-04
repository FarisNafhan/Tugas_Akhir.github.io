<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Produk Obat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan CSS tambahan di sini jika diperlukan */
        body {
            background-color: #f8f9fa;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php include "koneksi.php"; ?>
    <div class="container mt-5">
        <!-- Tombol untuk membuka modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
            Buka Form
        </button>

        <!-- Modal -->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Form Produk Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="obatForm" action="produk.php" method="POST" onsubmit="return validateForm()">
                            <div class="mb-3">
                                <label for="nama_obat" class="form-label">Nama Obat *</label>
                                <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Obat *</label>
                                <input type="number" class="form-control" id="harga" name="harga" required>
                            </div>
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan *</label>
                                <select class="form-select" id="satuan" name="satuan">
                                    <option value="Renteng">Renteng</option>
                                    <option value="PCS">PCS</option>
                                    <option value="Tube">Tube</option>
                                    <option value="Botol">Botol</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript dan dependensi Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        // JavaScript untuk validasi formulir
        function validateForm() {
            var namaObat = document.getElementById('nama_obat').value;
            var hargaObat = document.getElementById('harga').value;
            var stockObat = document.getElementById('stock').value;

            if (namaObat.trim() == '') {
                alert('Nama obat tidak boleh kosong');
                return false;
            }

            if (hargaObat.trim() == '') {
                alert('Harga obat tidak boleh kosong');
                return false;
            }

            if (stockObat.trim() == '') {
                alert('Stock obat tidak boleh kosong');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
