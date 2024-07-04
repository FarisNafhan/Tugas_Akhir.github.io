<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include "connection.php";
    $rifkirole = mysqli_query($conn, "SELECT * FROM `tb_role`");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <h1>edit user</h1>
    <from action="proses-user.php" method="post">
        <input type="hidden" name="id_role" value="<?= $id ?>">
        nama user<br><input type="text" name='editname'><br>
        username<br><input type="text" name='edituser'><br>
        password<br><input type="text" name='editpass'><br>
        <select name="editrole">
            <?php foreach ($rifkirole as $k => $v) { ?>
                <option value="<?= $v['id_role'] ?>"> <?= $v['nama_role'] ?></option>
            <?php } ?>
        </select>
        <input type="submit" name="edit">

</body>

</html>