<?php
include 'connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM `rifki_kategori` WHERE id_kategori=$id";
$hapus = mysqli_query($conn,$sql);
if($hapus){
echo"<script>alert('data kategori berhasil dihapus');window.location.href='master-kategori.php';</script>";
}
else
{echo"<script>alert('data kategori gagal dihapus');window.location.href='master-kategori.php';</script>";}
?>