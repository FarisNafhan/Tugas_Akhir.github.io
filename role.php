<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "navbar.php"; ?>
    <table>
        <tr>
            <th>#</th>
            <th>Level</th>
        </tr>
        <?php
        $role=mysqli_query($konek, "SELECT * FROM tb_role");
        while ($data=mysqli_fetch_array($role)){
        ?>
        <tr>
            <td><?= $data['id_role']; ?></td>
            <td><?= $data['level']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>