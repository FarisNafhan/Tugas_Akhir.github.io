<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            vertical-align: middle !important;
        }
        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="7">
                        <form action="proses_stock.php" method="post" class="d-flex">
                            <input type="text" name="search" class="form-control w-25" placeholder="Cari...">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                    </th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $show = mysqli_query($konek, "SELECT tb_obat.*, tb_kategori.kategori FROM tb_obat 
                                            INNER JOIN tb_kategori 
                                            ON tb_obat.id_kategori = tb_kategori.id_kategori;");
                while($data=mysqli_fetch_array($show)) {
                ?>
                <tr>
                    <td><?=$data['id_obat'];?></td>
                    <td><?=$data['nama_obat'];?></td>
                    <td><?=$data['harga'];?></td>
                    <td><?=$data['satuan'];?></td>
                    <td><?=$data['kategori'];?></td>
                    <td><?=$data['stock'];?></td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#stockObatModal<?=$data['id_obat']?>">pilih</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php
    $tambah = mysqli_query($konek, "SELECT * FROM tb_obat");

    while ($stock=mysqli_fetch_array($tambah)) {
    ?>
    <!-- Modal Stock -->
    <div class="modal fade" id="stockObatModal<?=$stock['id_obat']?>" tabindex="-1" aria-labelledby="stockObatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stockObatModalLabel">Form Edit Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="obatForm<?=$stock['id_obat']?>" action="proses_edit.php" method="POST">
                        <input type="hidden" name="id_obat" value="<?=$stock['id_obat']?>">
                        <div class="mb-3">
                            <label for="nama_obat" class="form-label">Nama Obat *</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?=$stock['nama_obat'];?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Obat *</label>
                            <input type="number" class="form-control" id="harga" name="harga" value="<?=$stock['harga'];?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan *</label>
                            <select class="form-select" id="satuan" name="satuan">
                                <option value="PCS" <?= ($stock['satuan'] == 'PCS') ? 'selected' : ''; ?>>PCS</option>
                                <option value="Tube" <?= ($stock['satuan'] == 'Tube') ? 'selected' : ''; ?>>Tube</option>
                                <option value="Botol" <?= ($stock['satuan'] == 'Botol') ? 'selected' : ''; ?>>Botol</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori *</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="1" <?= ($stock['id_kategori'] == 1) ? 'selected' : ''; ?>>Bebas</option>
                                <option value="2" <?= ($stock['id_kategori'] == 2) ? 'selected' : ''; ?>>Herbal</option>
                                <option value="3" <?= ($stock['id_kategori'] == 3) ? 'selected' : ''; ?>>Keras</option>
                                <option value="4" <?= ($stock['id_kategori'] == 4) ? 'selected' : ''; ?>>Narkotika</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="<?=$stock['stock'];?>">
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="return validateForm<?=$stock['id_obat']?>()">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        // JavaScript untuk validasi formulir
        function validateForm<?=$stock['id_obat']?>() {
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
