<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan gaya kustom di sini */
        body {
            background-color: #f8f9fa;
        }

        table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            vertical-align: middle !important;
        }

        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <?php
    include "navbar.php";
    $kat = mysqli_query($konek, "SELECT * FROM tb_kategori");
    ?>
    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="7">
                        <form action="" method="post" class="d-flex">
                            <input type="text" name="search" class="form-control w-25" placeholder="Cari...">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                    </th>
                </tr>
                <tr>
                    <?php if ($_SESSION['level'] == "Admin") { ?>
                    <th colspan="7">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahModal">
                            Tambah Obat
                        </button>
                    </th>
                    <?php } ?>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stock</th>
                    <?php if ($_SESSION['level'] == "Admin") { ?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $show = mysqli_query($konek, "SELECT tb_obat.*, tb_kategori.kategori FROM tb_obat 
                                            INNER JOIN tb_kategori 
                                            ON tb_obat.id_kategori = tb_kategori.id_kategori;");
                while ($data = mysqli_fetch_array($show)) {
                    ?>
                    <tr>
                        <td><?= $data['id_obat']; ?></td>
                        <td><?= $data['nama_obat']; ?></td>
                        <td><?= $data['harga']; ?></td>
                        <td><?= $data['kategori']; ?></td>
                        <td><?= $data['satuan']; ?></td>
                        <td><?= $data['stock']; ?></td>
                        <?php 
                        if ($_SESSION['level'] == "Admin") { ?>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editObatModal<?= $data['id_obat'] ?>">Edit
                            </button>
                            <a href="hapus_obat.php?id=<?= $data['id_obat'] ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button></a>
                        </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Form Produk Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="obatForm" action="proses_obat.php" method="POST" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="nama_obat" class="form-label">Nama Obat *</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Obat *</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori *</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="bebas">bebas</option>
                                <option value="herbal">herbal</option>
                                <option value="keras">keras</option>
                                <option value="narkotika">narkotika</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan *</label>
                            <select class="form-select" id="satuan" name="satuan">
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
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    $tambah = mysqli_query($konek, "SELECT tb_obat.*, tb_kategori.kategori FROM tb_obat 
                INNER JOIN tb_kategori 
                ON tb_obat.id_kategori = tb_kategori.id_kategori;");
    while ($edit = mysqli_fetch_array($tambah)) {
        ?>
        <!-- Modal Edit -->
<div class="modal fade" id="editObatModal<?= $edit['id_obat'] ?>" tabindex="-1" aria-labelledby="editObatModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editObatModalLabel">Form Edit Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="obatForm" action="proses_obat.php" method="POST">
                    <input type="hidden" name="id_obat" value="<?= $edit['id_obat']; ?>">
                    <div class="mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat *</label>
                        <input type="text" class="form-control" id="nama_obat" name="nama_obat"
                            value="<?= $edit['nama_obat']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Obat *</label>
                        <input type="number" class="form-control" id="harga" name="harga"
                            value="<?= $edit['harga']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan *</label>
                        <select class="form-select" id="satuan" name="satuan">
                            <option value="<?= $edit['satuan'] ?>"><?= $edit['satuan'] ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori *</label>
                        <select class="form-select" id="kategori" name="kategori" disabled>
                            <?php foreach ($kat as $k => $v) { ?>
                                <option value="<?= $v['kategori'] ?>" <?php if ($v['kategori'] == $edit['kategori']) echo 'selected="selected"'; ?>> <?= $v['kategori'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock"
                            value="<?= $edit['stock']; ?>" readonly>
                    </div>
                    <button type="submit" name="ubah" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <?php } ?>


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