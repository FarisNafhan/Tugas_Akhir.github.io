<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<?php
include "connection.php";

if (isset($_GET['id'])){
    $id = $_GET['id'];

    $rifkiedit = mysqli_query($conn, "SELECT * FROM `tb_role`");
}
?>

<body>
    <center>
    <h1>Edit User</h1>
    <form action="proses-user.php" method="post">
            <input type="hidden" name="id_user" value="<?=$id?>">
              Nama User</label><br>
            <input type="text" name="nama_user"  placeholder="Masukkan Nama User" required><br>
           
  Username</label><br>
            <input type="text" name="username" placeholder="Masukkan Username" required><br>

  Password</label><br>
            <input type="password" name="password" placeholder="Masukkan Password" required><br>
          
  Role</label><br>
            <select  name="edit_rifki_role" required>
                <?php foreach($rifkiedit as $k => $rifkivalue){?>
  <option value="<?=$rifkivalue['id_role']?>"><?= $rifkivalue['nama_role'] ?></option>
  <?php }?>
  
</select>
        </div>
        <input type="submit" name="edit" >
    </form>
    </center>
</body>
</html>