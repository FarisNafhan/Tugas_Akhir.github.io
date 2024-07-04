<?php
include 'connection.php';
if(isset($_POST['simpan'])){
    $nama = $_POST['nama_kategori'];
    $sql="INSERT into rifki_kategori VALUES (NULL ,'$nama');";
$ganti = mysqli_query($conn,$sql);
if($ganti){
    echo"<script>alert('data kategori berhasil ditambah');window.location.href='master-kategori.php';</script>";
}
else
{echo"<script>alert('data kategori gagal ditambah');window.location.href='tambah-kategori.php';</script>";}
}

if(isset($_POST['ubah'])){
    $id_kategori = $_POST['id'];
    $nama = $_POST['nama'];
    
    $result = mysqli_query($conn, "UPDATE `rifki_kategori` SET nama_kategori= '$nama' WHERE id_kategori= $id_kategori ");
    
    if($result){
        echo"<script>alert('data kategori berhasil di ubah');window.location.href='master-kategori.php';</script>";
    }
    else
    {echo"<script>alert('data kategori gagal di ubah');window.location.href='ubah-kategori.php';</script>";}
    }
    
    ?>