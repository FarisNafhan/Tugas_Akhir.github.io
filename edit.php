<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penambahan Obat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan CSS tambahan di sini jika diperlukan */
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<?php
include "koneksi.php";

$tambah = mysqli_query($konek, "SELECT * FROM tb_obat");
while ($edit=mysqli_fetch_array($tambah)) {
?>
<body>
    <div class="container">
        <form id="obatForm" action="proses_tambah.php" method="POST">
            <div class="mb-3">
                <label for="nama_obat" class="form-label">Nama Obat *</label>
                <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?=$edit['stock'];?>">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Obat *</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?=$edit['stock'];?>">
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
                <input type="number" class="form-control" id="stock" name="stock" value="<?=$edit['stock'];?>">
            </div>
            <button type="submit" class="btn btn-primary">Tambah Obat</button>
        </form>
    </div>
    <?php } ?>

    <!-- Bootstrap JavaScript dan dependensi Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
