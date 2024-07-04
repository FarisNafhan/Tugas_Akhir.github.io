<?php 
include "connection.php";

if(isset($_POST['cari'])){
$search = $_POST['search'];
$idkategori = $_POST['id_kategori'];
if ($idkategori != ""){
$user=mysqli_query($conn, "SELECT * FROM `rifki_menu`  
                            INNER JOIN rifki_kategori 
                            on rifki_kategori.id_kategori = rifki_menu.id_kategori
                            WHERE rifki_menu.nama_menu LIKE '%$search%'
                            AND rifki_kategori.id_kategori=$idkategori");
} else {
    $user=mysqli_query($conn, "SELECT * FROM `rifki_menu`  
                            INNER JOIN rifki_kategori 
                            on rifki_kategori.id_kategori = rifki_menu.id_kategori
                            WHERE rifki_menu.nama_menu LIKE '%$search%'");

}

} else{

$user=mysqli_query($conn, "SELECT * FROM `rifki_menu` 
                             INNER JOIN rifki_kategori 
                             on rifki_kategori.id_kategori = rifki_menu.id_kategori");
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
<h1>Data user</h1>
<a href="tambah-menu.php"class="btn btn-warning">➕tambah menu</a><br>

<form method='POST'>
 search <input type="text" name="search">
 <input type="submit" name="cari" value="cari"><br>
 <?php 
 $kategori = mysqli_query($conn,"SELECT * FROM rifki_kategori");
 ?>
 <select name="id_kategori" id="form-kategori">
    <option value="">ALL</option>
    <?php
    foreach ($kategori as $kat){
        echo"<option value='".$kat['id_kategori']."'>"
        .$kat['nama_kategori']."</option>";
    }
    ?>
    </select>
</form>

<table class="custom">
        <tr>
            <th>ID menu</th>
            <th>Nama menu</th>
            <th>harga menu</th>
            <th>id kategori</th>
            <th>foto menu</th>
            <th>status menu</th>
            <th>aksi</th>

        </tr>
        <?php foreach($user as $rifkirow):?>
        <tr>
            <td><?= $rifkirow['id_menu']; ?></td>
            <td><?= $rifkirow['nama_menu']; ?></td>
            <td><?= $rifkirow['harga_menu'];?></td>
            <td><?= $rifkirow['id_kategori'];?></td>
            <td><img width="100px"; height="90px"; src="img/<?= $rifkirow['foto_menu'];?>"></td>
            <td><?= $rifkirow['status_menu']; ?></td>
            <td><a href="ubah-menu.php?id=<?= $rifkirow['id_menu'];?>"class="btn btn-warning">⚙edit</a>|
            <a href="hapus-menu.php?id=<?= $rifkirow['id_menu'];?>"class="btn btn-danger">🗑hapus</a></td>
        </tr>
        <?php endforeach; ?>
       
    </table>
        </center>