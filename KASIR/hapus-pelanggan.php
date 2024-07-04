<?php
include 'connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM `rifki_pelanggan` WHERE id_pelanggan=$id";
$hapus = mysqli_query($conn,$sql);
if($hapus){
echo"<script>alert('data pelanggan berhasil dihapus');window.location.href='master-pelanggan.php';</script>";
}
else
{echo"<script>alert('data pelanggan gagal dihapus');window.location.href='master-pelanggan.php';</script>";}
?>