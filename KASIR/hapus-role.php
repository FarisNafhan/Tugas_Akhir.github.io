<?php
include 'connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM `tb_role` WHERE id_role=$id";
$hapus = mysqli_query($conn,$sql);
if($hapus){
echo"<script>alert('data role berhasil dihapus');window.location.href='maste-role.php';</script>";
}
else
{echo"<script>alert('data role gagal dihapus');window.location.href='maste-role.php';</script>";}
?>