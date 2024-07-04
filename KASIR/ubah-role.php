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
    $id_role = $_GET['id'];

    $rifkiedit = mysqli_query($conn, "SELECT * FROM `tb_role`");
}
   ?>
 <form method="post" action="proses-role.php">
    <input type="hidden" name="id_role" value="<?=$id_role?>">
    <h1>ubah role</h1>
    nama role:<br>
    <input type="text" name="nama_role" placeholder="masukkan nama role" required><br>
    <input type="submit" name="ubah" value="ubah">
</form>
</body>
</html>