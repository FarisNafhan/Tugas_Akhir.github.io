<?php
include "connection.php";
if(isset($_POST['cari'])){
    $search = $_POST['search'];
    $user=mysqli_query($conn, "SELECT * FROM `rifki_pelanggan`  
                                WHERE rifki_pelanggan.nama_pelanggan LIKE '%$search%'");
 
    
    } else{
        $user=mysqli_query($conn, "SELECT * FROM `rifki_pelanggan`");
    }

?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" type="text/css" href="table.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<body>
    <?php include "navbar.php";
     ?>
     <center>
<h1>Data user</h1>
<a href="tambah-pelanggan.php"class="btn btn-warning">➕tambah pelanggan</a><br>

<form method='POST'>
 search <input type="text" name="search">
 <input type="submit" name="cari" value="cari"><br>
</form>

<table class="custom" style="margin-left : 15%">
        <tr>
            <th>ID pelanggan</th>
            <th>Nama pelanggan</th>
            <th>alamat</th>
            <th>nomor telepon</th>
            <th>jenis kelamin</th>
            <th>TTL</th>
            <th>jenis pelanggan</th>
            <th>aksi</th>

        </tr>
        <?php foreach($user as $rifkirow):?>
        <tr>
       <?php $tanggalahir = strtotime( $rifkirow['tanggal_lahir']);?>
            <td><?= $rifkirow['id_pelanggan']; ?></td>
            <td><?= $rifkirow['nama_pelanggan']; ?></td>
            <td><?= $rifkirow['alamat'];?></td>
            <td><?= $rifkirow['no_telepon'];?></td>
            <td><?= $rifkirow['jenis_kelamin'];?></td>
            <td><?= $rifkirow['tempat_lahir']; ?>,<?= date('d-m-Y',$tanggalahir);?></td>
            <td><?= $rifkirow['jenis_pelanggan']; ?></td>
            <td><a href="ubah-pelanggan.php?id=<?= $rifkirow['id_pelanggan'];?>"class="btn btn-warning">⚙edit</a>|
            <a href="hapus-pelanggan.php?id=<?= $rifkirow['id_pelanggan'];?>"class="btn btn-danger">🗑hapus</a></td>
        </tr>
        <?php endforeach; ?>
       
    </table>
    <center>