<?php
include 'koneksi.php';

// Proses Tambah
if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $level = $_POST['level'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input tidak boleh kosong
    if (empty($level) || empty($nama) || empty($username) || empty($password)) {
        echo "
        <script>
        alert('Semua input harus diisi');
        window.location.href='user.php';
        </script>";
        exit; // Menghentikan eksekusi script selanjutnya jika ada input yang kosong
    }

    // Lanjut ke proses tambah jika tidak ada input yang kosong

    // Query untuk mendapatkan id_role berdasarkan level
    $query_role = mysqli_query($konek, "SELECT id_role FROM tb_role WHERE level = '$level'");

    // Periksa apakah query berhasil dijalankan
    if ($query_role) {
        // Ambil id_role dari hasil query
        $result = mysqli_fetch_assoc($query_role);
        $id_role = $result['id_role'];

        // Sisipkan data ke dalam tabel tb_user
        $ganti = mysqli_query($konek, "INSERT INTO tb_user (id_role, nama, username, password) VALUES ('$id_role', '$nama', '$username', '$password')");

        if ($ganti) {
            echo "
            <script>
            alert('Data user berhasil ditambah');
            window.location.href='user.php';
            </script>";
        } else {
            echo "
            <script>
            alert('Gagal menambahkan data user');
            window.location.href='user.php';
            </script>";
        }
    } else {
        echo "
        <script>
        alert('Gagal mendapatkan id_role');
        window.location.href='user.php';
        </script>";
    }
}

// Proses Edit
if (isset($_POST['ubah'])) {
    // Ambil data dari form
    $id = $_POST['id_user'];
    $level = $_POST['level'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input tidak boleh kosong
    if (empty($level) || empty($nama) || empty($username)) {
        echo "
        <script>
        alert('Semua input kecuali password harus diisi');
        window.location.href='user.php';
        </script>";
        exit; // Menghentikan eksekusi script selanjutnya jika ada input yang kosong
    }

    // Lanjut ke proses edit jika tidak ada input yang kosong

    // Query untuk mendapatkan id_role dari pengguna yang diedit
    $query_user_role = mysqli_query($konek, "SELECT id_role FROM tb_user WHERE id_user = '$id'");

    // Periksa apakah query berhasil dijalankan
    if ($query_user_role) {
        // Ambil id_role dari hasil query
        $result_user_role = mysqli_fetch_assoc($query_user_role);
        $id_role = $result_user_role['id_role'];

        // Perbarui data kecuali level
        $ganti = mysqli_query($konek, "UPDATE tb_user SET id_role='$id_role', nama='$nama', username='$username', password='$password' WHERE id_user = '$id'");

        if ($ganti) {
            echo "
            <script>
            alert('Data user berhasil diubah');
            window.location.href='user.php';
            </script>";
        } else {
            echo "
            <script>
            alert('Gagal mengubah data user');
            window.location.href='user.php';
            </script>";
        }
    } else {
        // Tampilkan pesan error dari query MySQL jika query SELECT tidak berhasil dieksekusi
        die('Error: ' . mysqli_error($konek));
    }
}
?>
