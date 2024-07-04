<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .modal-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
        }

        .modal-title {
            font-size: 1.25rem;
        }
    </style>
</head>

<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKategori">
                Tambah Kategori
            </button>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $kategori = mysqli_query($konek, "SELECT * FROM tb_kategori");
                while ($data = mysqli_fetch_array($kategori)) {
                ?>
                    <tr>
                        <td><?= $data['id_kategori']; ?></td>
                        <td><?= $data['kategori']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Kategori -->
    <div class="modal fade" id="modalKategori" tabindex="-1" aria-labelledby="modalKategoriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKategoriLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="proses_kategori.php" method="post">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" name="kategori" id="kategori">
                        </div>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
