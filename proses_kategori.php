<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $nama = $_POST['kategori'];

    $ganti = mysqli_query($konek, "INSERT INTO tb_kategori VALUES (NULL ,'$nama');");
    if ($ganti) {
        echo "<script>alert('data kategori berhasil ditambah');window.location.href='kategori.php';</script>";
    } else {
        echo "<script>alert('data kategori gagal ditambah');window.location.href='kategori.php';</script>";
    }
}
?>