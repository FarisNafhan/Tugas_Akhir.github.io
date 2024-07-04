<?php
    include 'connection.php';
?>

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

    $rifkiedit = mysqli_query($conn, "SELECT * FROM `rifki_kategori`");
}
   ?>
 <form method="post" action="proses-kategori.php">
    
    <h1>ubah kategori</h1>
    nama kategori:<br>
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="text" name="nama" placeholder="masukkan nama kategori" required ><br>
    <input type="submit" name="ubah" value="ubah">
</form>
</body>
</html>