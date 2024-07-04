<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="tabel.css">
</head>
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
<body>
    <?php
    include "navbar.php";

    $role = mysqli_query($konek, "SELECT * FROM tb_role");
    ?>
    <div class="container mt-5">

        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                Tambah User
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>ID User</th>
                        <th>Role</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user = mysqli_query($konek, "SELECT tb_user.*, tb_role.level FROM tb_user 
                        INNER JOIN tb_role 
                        ON tb_role.id_role = tb_user.id_role");
                    while ($data = mysqli_fetch_array($user)) {
                        ?>
                        <tr>
                            <td><?= $data['id_user']; ?></td>
                            <td><?= $data['level']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['username']; ?></td>
                            <td class="action-links">
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#modalEdit<?= $data['id_user']; ?>">Edit</button>
                                <a href="hapus_user.php?id=<?= $data['id_user']; ?>"><button type="submit"
                                        class="btn btn-sm btn-danger">Hapus</button></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah User -->

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Form Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="proses_user.php" method="post">
                        <div class="mb-3">
                            <label for="level" class="form-label">Level *</label>
                            <select name="level" id="level" class="form-control">
                                <option value="Admin">Admin</option>
                                <option value="Karyawan">Karyawan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama *</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit User -->
    <?php
$edit = mysqli_query($konek, "SELECT tb_user.*, tb_role.level FROM tb_user 
    INNER JOIN tb_role 
    ON tb_role.id_role = tb_user.id_role");
while ($user = mysqli_fetch_array($edit)) {
?>
<div class="modal fade" id="modalEdit<?= $user['id_user']; ?>" tabindex="-1"
    aria-labelledby="modalEditLabel<?= $user['id_user']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel<?= $user['id_user']; ?>">Form Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="proses_user.php" method="post">
                    <div class="mb-3">
                        <label for="level" class="form-label">Level *</label>
                        <select name="level" id="level" class="form-control">
                            <?php foreach ($role as $r => $d) { ?>
                                <option value="<?= $d['id_role'] ?>" <?= ($user['level'] == $d['level']) ? 'selected' : '' ?>>
                                    <?= $d['level'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama *</label>
                        <input type="text" name="nama" id="nama" value="<?= $user['nama'] ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" value="<?= $user['username'] ?>"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="<?= $user['password'] ?>">
                    </div>
                    <!-- Tambahkan input hidden untuk menyimpan ID pengguna -->
                    <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>