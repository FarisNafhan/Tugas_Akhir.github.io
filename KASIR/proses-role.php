<?php
include 'connection.php';
if(isset($_POST['simpan'])){
    $nama = $_POST['nama_role'];
    $sql="INSERT into tb_role VALUES (NULL ,'$nama');";
$ganti = mysqli_query($conn,$sql);
if($ganti){
    echo"<script>alert('data role berhasil ditambah');window.location.href='maste-role.php';</script>";
}
else
{echo"<script>alert('data role gagal ditambah');window.location.href='tambah-role.php';</script>";}
}

elseif(isset($_POST['ubah'])){
$id_role = $_POST['id_role'];
$nama = $_POST['nama_role'];

$result = mysqli_query($conn, "UPDATE tb_role SET nama_role='$nama' WHERE id_role=$id_role");

if($result){
    echo"<script>alert('data role berhasil di ubah');window.location.href='maste-role.php';</script>";
}
else
{echo"<script>alert('data role gagal di ubah');window.location.href='ubah-role.php';</script>";}
}

?>