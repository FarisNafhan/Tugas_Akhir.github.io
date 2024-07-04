<?php
include 'connection.php';
if(isset($_POST['simpan'])){
    $role=$_POST['nama_user'];
    $rifkiusername = $_POST['username'];
    $rifkipass = $_POST['password'];
    $rifkipassword = md5($rifkipass);
    $rifkirole = $_POST['newrole'];
    $sql="INSERT into tb_user VALUES (NULL ,$rifkirole,'$rifkiusername' ,'$rifkipassword' ,'$role');";
$rifkitambah = mysqli_query($conn,$sql);
if($rifkitambah){
    echo"<script>alert('data user berhasil ditambah');window.location.href='master-user.php';</script>";
}
else
{echo"<script>alert('data user gagal ditambah');window.location.href='tambah-user.php';</script>";}
}

if (isset($_POST['edit'])){
    $id = $_POST['id_user'];
    $rifkiN = $_POST['nama_user'];
    $rifkiU = $_POST['username'];
    $rifkiP = $_POST['password'];
    $rifkipass = md5($rifkiP);
    $rifkiR = $_POST['edit_rifki_role'];

    $rifkiEdit = mysqli_query($conn, "UPDATE `tb_user` SET username='$rifkiU', nama_user='$rifkiN', id_role='$rifkiR' WHERE `id_user` = $id");
    
    if ($rifkit){
        echo"<script>
        alert('Data User Gagal di Simpan');
        window.location.href='master-user.php';
        </script>";
    } else {
        echo"<script>
        alert('Data User Berhasil di Simpan');
        window.location.href='master-user.php';
        </script>";
    }}