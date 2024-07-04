<?php
include 'connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM rifki_menu WHERE id_menu=$id";
$hapus = mysqli_query($conn,$sql);
if($hapus){
echo"<script>alert('data menu berhasil dihapus');window.location.href='master-menu.php';</script>";
}
else
{echo"<script>alert('data menu gagal dihapus');window.location.href='master-menu.php';</script>";}
?>