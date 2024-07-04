<?php session_start();
include 'connection.php';
if($_SESSION['status'] != "login"){
    echo "<script>window.location.href='index.php?pesan=belum_login'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>welcome!</h1>
    <ul class="top">
        <li><a href="#">dashboard</a></li>
        <?php if($_SESSION['id_role'] == 6){ ?>
        <li><a href="master-user.php">user</a></li>
        <li><a href="maste-role.php">role</a></li>
        <li><a href="master-pelanggan.php">pelanggan</a></li>
        <li><a href="master-kategori.php">kategory menu</a></li>
        <li><a href="master-menu.php">menu</a></li>
        <li><a href="#">order</a></li>
        <li><a href="#">pembayaran</a></li>
        <?php } ?>
        <?php if($_SESSION['id_role'] == 7){ ?>
        <li><a href="#">order</a></li>
        <li><a href="#">pembayaran</a></li>
        <?php } ?>
        <?php  if($_SESSION['id_role'] == 8){ ?>
        <li><a href="#">laporan</a></li>
        <?php } ?>
        <div class="logout">
        <li><a href="logout.php">logout</a></li>
        </div>
</ul>
<strong><?=$_SESSION['nama_user'] ?></strong>
</div>
</body>
</html>