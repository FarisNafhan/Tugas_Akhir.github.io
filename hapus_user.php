<?php
include 'koneksi.php';

// Hapus data user jika parameter 'id' telah diterima
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];
    
    // Lakukan penghapusan data user dari database
    $hapus = mysqli_query($konek, "DELETE FROM tb_user WHERE id_user = '$id_user'");
    
    if ($hapus) {
        echo "
        <script>
        alert('Data user berhasil dihapus');
        window.location.href='user.php';
        </script>";
    } else {
        echo "
        <script>
        alert('Gagal menghapus data user');
        window.location.href='user.php';
        </script>";
    }
} else {
    echo "
    <script>
    alert('ID user tidak ditemukan');
    window.location.href='user.php';
    </script>";
}
?>
