<?php 
include "connection.php";

if(isset($_POST['cari'])){
    $search = $_POST['search'];
    $user=mysqli_query($conn, "SELECT * FROM `rifki_kategori`  
                                WHERE rifki_kategori.nama_kategori LIKE '%$search%'");
 
    
    } else{
        $user=mysqli_query($conn, "SELECT * FROM `rifki_kategori`");
    }?>



<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" type="text/css" href="table.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<body>

    <?php include "navbar.php";?>
    <center>
<h1>Kategori Menu</h1>
<a href="tambah-kategori.php"class="btn btn-warning">➕tambah kategori</a><br>

<form method='POST'>
 search <input type="text" name="search">
 <input type="submit" name="cari" value="cari"><br>
</form>
<table class="custom">
        <tr>
            <th>ID kategori</th>
            <th>Nama kategori</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($user as $rifkirow):?>
        <tr>
            <td><?= $rifkirow['id_kategori']; ?></td>
            <td><?= $rifkirow['nama_kategori']; ?></td>
            <td><a href="ubah-kategori.php?id=<?= $rifkirow['id_kategori'];?>"class="btn btn-warning">⚙edit</a>|
            <a href="hapus-kategori.php?id=<?= $rifkirow['id_kategori'];?>"class="btn btn-danger">🗑hapus</a></td>
        </tr>
        <?php endforeach; ?>
       
    </table>
    <center>