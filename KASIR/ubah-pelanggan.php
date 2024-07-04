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
    $id= $_GET['id'];

    $sql = mysqli_query($conn, "SELECT * FROM `rifki_pelanggan`");
}
   ?>
    <form method="post" action="proses-pelanggan.php">
    <input type="hidden" name="id" value="<?=$id?>">
    <h1>tambah pelanggan</h1>
    nama pelanggan:<br>
    <input type="text" name="nama_pelanggan" placeholder="masukkan nama pelanggan" required><br>
    alamat:<br>
    <input type="text" name="alamat"  required><br>
    no telepon:<br>
    <input type="text" name="no"  required><br>
    jenis kelamin:<br>
    <select name="kelamin">
    <option value="perempuan">perempuan</option>
    <option value="laki-laki">laki-laki</option>
   </select>
   <bR>tempat lahir: <br>
   <input type="text" name="tempat" required><br>
   tanggal lahir:<br>
   <input type="date" name="tanggal" required><br>
    status pelanggan:<br>
<select name="status">
    <option value="gold">gold</option>
    <option value="silver">silver</option>
    <option value="bronze">bronze</option>
   </select>
    <input type="submit" name="ubah" value="ubah">
</form>
</body>
</html>