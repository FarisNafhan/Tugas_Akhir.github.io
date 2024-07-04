<?php
$konek=mysqli_connect("localhost","root","","kasir_apotek");

//check
if (mysqli_connect_error()) {
    echo "Something Wrong : " . mysqli_connect_error();
}
?>