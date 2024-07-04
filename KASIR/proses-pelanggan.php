<?php
include 'connection.php';
if(isset($_POST['simpan'])){
    $rifkinama=$_POST['nama_pelanggan'];
    $rifkialamat = $_POST['alamat'];
    $rifkino = $_POST['no'];
    $rifkikelamin = $_POST['kelamin'];
    $rifkitempat = $_POST['tempat'];
    $rifkitanggal = $_POST['tanggal'];
    $rifkistatus = $_POST['status'];

    $sql="INSERT into rifki_pelanggan VALUES (NULL ,'$rifkinama','$rifkialamat' ,'$rifkino' ,'$rifkikelamin','$rifkitempat','$rifkitanggal','$rifkistatus');";
$rifkitambah = mysqli_query($conn,$sql);
if($rifkitambah){
    echo"<script>alert('data pelanggan berhasil ditambah');window.location.href='master-pelanggan.php';</script>";
}
else
{echo"<script>alert('data pelanggan gagal ditambah');window.location.href='tambah-pelanggan.php';</script>";}
}
if (isset($_POST['ubah'])){
    $id = $_POST['id'];
    $rifkinama=$_POST['nama_pelanggan'];
    $rifkialamat = $_POST['alamat'];
    $rifkino = $_POST['no'];
    $rifkikelamin = $_POST['kelamin'];
    $rifkitempat = $_POST['tempat'];
    $rifkitanggal = $_POST['tanggal'];
    $rifkistatus = $_POST['status'];

        $query = mysqli_query($conn, "UPDATE `rifki_pelanggan` SET `nama_pelanggan` = '$rifkinama', `alamat` = '$rifkialamat', `no_telepon` = '$rifkino', `jenis_kelamin` = '$rifkikelamin', `tempat_lahir` = '$rifkitempat', `tanggal_lahir` = '$rifkitanggal', `jenis_pelanggan` = '$rifkistatus' WHERE `id_pelanggan` = '$id'");
    
    if ($query){
        echo"<script>
        alert('Data pelanggan berhasil di ubah');
        window.location.href='master-pelanggan.php';
        </script>";
    } else {
        echo"<script>
        alert('Data pelanggan gagal di ubah');
        window.location.href='master-pelanggan.php';
        </script>";
    }}