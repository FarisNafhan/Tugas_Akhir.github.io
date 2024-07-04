<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mendapatkan data user berdasarkan username dan password
$login = mysqli_query($konek, "SELECT u.*, r.level FROM `tb_user` u
                                INNER JOIN tb_role r ON u.id_role = r.id_role
                                WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $row = mysqli_fetch_assoc($login);

    $_SESSION['username'] = $row['username'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['level'] = $row['level'];
    $_SESSION['id_user'] = $row['id_user']; // Simpan ID User ke dalam session

    echo "ID User: " . $_SESSION['id_user']; // Debugging: Cetak ID User untuk memastikan nilai sudah tersimpan

    // Redirect sesuai level user
    if ($row['level'] == "Admin") {
        header("location:page_admin.php");
    } elseif ($row['level'] == "Karyawan") {
        header("location:page_karyawan.php");
    } else {
        header("location:index.php?cek=gagal");
    }
} else {
    header("location:index.php?cek=gagal");
}

?>
