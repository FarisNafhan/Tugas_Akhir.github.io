<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="tabel.css">
</head>

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
                                <button type="button" class="btn btn-sm btn-info"
                                    onclick="fillEditModal(<?php echo $data['id_user']; ?>)">Edit</button>
                                <a href="hapus_user.php?id=<?= $data['id_user']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Form Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="proses_edit_user.php" method="post">
                        <div class="mb-3">
                            <label for="edit-level" class="form-label">Level *</label>
                            <select name="edit-level" id="edit-level" class="form-control">
                                <!-- Pilihan level akan diisi dengan data dari database -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-nama" class="form-label">Nama *</label>
                            <input type="text" name="edit-nama" id="edit-nama" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit-username" class="form-label">Username</label>
                            <input type="text" name="edit-username" id="edit-username" class="form-control">
                        </div>
                        <input type="hidden" name="edit-id-user" id="edit-id-user">
                        <!-- ID User yang diedit (hidden) -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit User -->

    <!-- Modal Edit User tidak diulang untuk masing-masing baris karena tidak perlu, cukup satu modal yang akan menyesuaikan data yang akan diedit -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function fillEditModal(id) {
            // Mengambil data pengguna dari server menggunakan AJAX
            $.ajax({
                url: 'proses_user.php', // Ganti dengan URL yang sesuai untuk mengambil data pengguna dari server
                method: 'GET',
                data: { id: id }, // Kirim ID pengguna ke server
                dataType: 'json', // Mengharapkan data JSON dari server
                success: function (response) {
                    // Mengisi nilai-nilai input dalam modal edit dengan data yang diterima dari server
                    $('#modalEdit #level').val(response.level);
                    $('#modalEdit #nama').val(response.nama);
                    $('#modalEdit #username').val(response.username);

                    // Tampilkan modal edit
                    $('#modalEdit').modal('show');
                },
                error: function (xhr, status, error) {
                    // Tampilkan pesan kesalahan jika terjadi masalah saat mengambil data
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

</body>

</html>