<?php
include 'connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM tb_user WHERE id_user=$id";
$hapus = mysqli_query($conn,$sql);
if($hapus){
echo"<script>alert('data user berhasil dihapus');window.location.href='master-user.php';</script>";
}
else
{echo"<script>alert('data user gagal dihapus');window.location.href='master-user.php';</script>";}


?>