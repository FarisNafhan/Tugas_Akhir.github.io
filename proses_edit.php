<?php
session_start();
include('koneksi.php');

// Periksa apakah `id_obat` disertakan dalam permintaan POST
if (!isset($_POST['id_obat'])) {
    $_SESSION['error'] = "ID Obat tidak valid.";
    header("Location: stock.php");
    exit();
}

$id_obat = $_POST['id_obat'];
$nama_obat = $_POST['nama_obat'];
$harga = $_POST['harga'];
$satuan = $_POST['satuan'];
$id_kategori = $_POST['kategori'];
$stock = $_POST['stock'];

// Perbarui data obat di database
$sql = "UPDATE tb_obat SET nama_obat = ?, harga = ?, satuan = ?, id_kategori = ?, stock = ? WHERE id_obat = ?";
$stmt = $konek->prepare($sql);
$stmt->bind_param("sisiii", $nama_obat, $harga, $satuan, $id_kategori, $stock, $id_obat);

if ($stmt->execute()) {
    $_SESSION['success'] = "Data obat berhasil diperbarui.";
} else {
    $_SESSION['error'] = "Gagal memperbarui data obat.";
}

header("Location: stock.php");
exit();
?>

