<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai</title>
</head>
<?php include "navbar.php"; ?>
<body>
    <?php
// echo $_SESSION['nama'];
    if ($_SESSION['level'] == "") {
        header("location:index.php?cek=gagal");
        
    }
    ?>

</body>
</html>