<?php
include "connection.php";
if(isset($_POST['cari'])){
    $search = $_POST['search'];
    $idkategori = $_POST['id_kategori'];
    if ($idkategori != ""){
    $user=mysqli_query($conn, "SELECT * FROM `tb_user`  
                                INNER JOIN tb_role
                                on tb_role.id_role = tb_user.id_role
                                WHERE tb_user.nama_user LIKE '%$search%'
                                AND tb_role.id_role=$idkategori");
    } else {
        $user=mysqli_query($conn, "SELECT * FROM `tb_user`  
                                INNER JOIN tb_role 
                                on tb_role.id_role = tb_user.id_role
                                WHERE tb_user.nama_user LIKE '%$search%'");
    
    }
    
    } else{
    
        $user=mysqli_query($conn, "SELECT * FROM `tb_user` INNER JOIN tb_role on tb_role.id_role = tb_user.id_role");

    }?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" type="text/css" href="table.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<body>
    <div class="container">
    <div class="main">
    <?php include "navbar.php";?>
    <center>
<h1>Data user</h1>
<a href="tambah-user.php"class="btn btn-warning">➕tambah data user</a><br>

<form method='POST'>
 search <input type="text" name="search">
 <input type="submit" name="cari" value="cari"><br>
 <?php 
 $kategori = mysqli_query($conn,"SELECT * FROM tb_role");
 ?>
 <select name="id_kategori" id="form-kategori">
    <option value="">ALL</option>
    <?php
    foreach ($kategori as $kat){
        echo"<option value='".$kat['id_role']."'>"
        .$kat['nama_role']."</option>";
    }
    ?>
    </select>
</form>
<table class="custom" style="margin-right : 10%">
        <tr> 
            <th>ID user</th>
            <th>Nama User</th>
            <th>Username</th>
            <th>role</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($user as $rifkirow):?>
        <tr>
            <td><?= $rifkirow['id_user']; ?></td>
            <td><?= $rifkirow['nama_user']; ?></td>
            <td><?= $rifkirow['username'];?></td>
            <td><?= $rifkirow['nama_role'];?></td>
            <td><a href="ubah-user.php?id=<?= $rifkirow['id_user'];?>"class="btn btn-warning">⚙edit</a>|
            <a href="hapus-user.php?id=<?= $rifkirow['id_user'];?>"class="btn btn-danger">🗑hapus</a></td>
        </tr>
        <?php endforeach; ?>
       
    </table>
    <center>
    </div>
    </div>