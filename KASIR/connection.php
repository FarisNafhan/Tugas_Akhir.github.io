<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "kasir";

$conn = new mysqli($host,$username,$password,$database);

if($conn->connect_error){
    echo"gagal koneksi ke database";
}else{
//echo"koneksi berhasil";
}
?>