<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
        echo"<script>window.location.href='home.php'</script>";
    }?>
    <center>
        <div class="login">
    <h2>please sign in</h2>
    <form action="ceklogin.php" method="post">
    username<br>
    <input type="text" name="username" placeholder="masukkan username" required><br>
    password<br>
    <input type="password" name="password" placeholder="masukkan password" required><br>
    <input type="submit" name="login" value="login">
</form>
</div>
</body>
</html>