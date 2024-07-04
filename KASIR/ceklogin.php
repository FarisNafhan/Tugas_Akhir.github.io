<?php
session_start();

include "connection.php";

    $username=$_POST['username'];
    $password=md5($_POST['password']);

$query = mysqli_query($conn,"SELECT * from `tb_user`
                             where username='$username' 
                             and password='$password'");

$count = mysqli_num_rows($query);
if($count > 0 ){
    $login = mysqli_fetch_array($query);

$_SESSION['id_user'] = $login['id_user'];
$_SESSION['username'] = $login['username'];
$_SESSION['id_role'] = $login['id_role'];
$_SESSION['nama_user'] = $login['nama_user'];
$_SESSION['status'] = 'login';

if ($login['id_role'] == 6){
    header("location:navbar.php");
}elseif ($login['id_role'] == 7){
    header("location:navbar.php");
}elseif ($login['id_role'] == 8){
    header("location:navbar.php");
}else{
}

}

?>