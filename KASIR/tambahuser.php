
<?php 
include "connection.php";
$rifkirole = mysqli_query($conn, "SELECT * FROM `tb_role`"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method="post" action="proses-user.php">
    <h1>tambah user</h1>
    nama user:<br>
    <input type="text" name="nama_user" placeholder="masukkan nama user" required><br>
    username:<br>
    <input type="text" name="username" placeholder="masukkan username" required><br>
    password:<br>
    <input type="text" name="password" placeholder="masukkan pasword" required><br>
    <select name="newrole">
   <?php foreach($rifkirole as $k => $v){?>
    <option value="<?=$v['id_role']?>"> <?=$v['nama_role']?></option>
    <?php } ?>
   </select>
    <input type="submit" name="simpan" value="simpan">
</form>
</body>
</html>