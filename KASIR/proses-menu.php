<?php
include 'connection.php';
if(isset($_POST['simpan'])){
    $rifkinama=$_POST['nama_menu'];
    $rifkiharga = $_POST['harga_menu'];
    $rifkikategori = $_POST['kategori'];
    $rifkifoto = $_POST['foto_menu'];
    $rifkistatus = $_POST['status_menu'];
    $sql="INSERT into rifki_menu VALUES (NULL ,'$rifkinama','$rifkiharga' ,'$rifkikategori' ,'$rifkifoto','$rifkistatus');";
$rifkitambah = mysqli_query($conn,$sql);
if($rifkitambah){
    echo"<script>alert('data menu berhasil ditambah');window.location.href='master-menu.php';</script>";
}
else
{echo"<script>alert('data menu gagal ditambah');window.location.href='tambah-menu.php';</script>";}
}

if (isset($_POST['ubah'])){
    $id = $_POST['id'];
        $rifkinama=$_POST['nama_menu'];
        $rifkiharga = $_POST['harga_menu'];
        $rifkikategori = $_POST['kategori'];
        $rifkifoto = $_POST['foto_menu'];
        $rifkistatus = $_POST['status_menu'];

        $query = mysqli_query($conn, "UPDATE `rifki_menu` SET `nama_menu` = '$rifkinama', `harga_menu` = '$rifkiharga', `id_kategori` = '$rifkikategori', `foto_menu` = '$rifkifoto', `status_menu` = '$rifkistatus' WHERE `id_menu` = '$id'");
    
    if ($query){
        echo"<script>
        alert('Data User berhasil di Simpan');
        window.location.href='master-menu.php';
        </script>";
    } else {
        echo"<script>
        alert('Data User gagal di Simpan');
        window.location.href='master-menu.php';
        </script>";
    }}