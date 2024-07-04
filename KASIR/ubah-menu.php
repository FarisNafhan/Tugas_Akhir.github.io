<?php 
include "connection.php";
$rifkikategori = mysqli_query($conn, "SELECT * FROM `rifki_kategori`"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];

}
   ?>
    <form method="post" action="proses-menu.php">
    <input type="hidden" name="id" value="<?=$id?>">
    <h1>tambah menu</h1>
    nama menu:<br>
    <input type="text" name="nama_menu" placeholder="masukkan nama menu" required><br>
    harga menu:<br>
    <input type="text" name="harga_menu"  required><br>
    kategori:
    <select name="kategori">
   <?php foreach($rifkikategori as $k => $v){?>
    <option value="<?=$v['id_kategori']?>"> <?=$v['nama_kategori']?></option>
    <?php } ?>
   </select>
   <br>foto menu:<br>
    <input type="file" name="foto_menu"   required><br>
    status menu:<br>
<select name="status_menu">
    <option value="tersedia">tersedia</option>
    <option value="tidak tersedia">tidak tersedia</option>
   </select>
    <input type="submit" name="ubah" value="ubah">
</form>
</body>
</html>