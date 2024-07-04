<?php
include "connection.php";

$user=mysqli_query($conn, "SELECT * FROM `tb_user` INNER JOIN tb_role on tb_role.id_role = tb_user.id_role");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" type="text/css" href="tabel.css">
</head>
<body>
    <?php include "home.php";?>
<h1>Data user</h1>
<a href="tambahuser.php">tambah data user</a><br>
<?php
include "connection.php";
?>

<table class="custom">
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
            <td><a href="ubah-user.php?id=<?= $rifkirow['id_user'];?>">edit</a>|
            <a href="hapus-user.php?id=<?= $rifkirow['id_user'];?>">hapus</a></td>
        </tr>
        <?php endforeach; ?>
       
    </table>