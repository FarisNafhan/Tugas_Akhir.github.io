<?php
include "koneksi.php";

$nama_obat = $_POST['nama_obat'];
$harga_obat = $_POST['harga'];
$satuan_obat = $_POST['satuan'];
$stock_obat = $_POST['stock']; 

$sql = "INSERT INTO tb_obat (nama_obat, harga, satuan, stock) VALUES ('$nama_obat', '$harga_obat', '$satuan_obat', '$stock_obat')";

if ($konek->query($sql) === TRUE) {

  echo "
  <script>
    alert('Data telah disimpan');
    window.location.href='obat.php';
  </script>";
} else {
  echo "
  <script>
    alert('Data gagal disimpan');
    window.location.href='obat.php';
  </script>";
}

$konek->close();
?>