<?php
include 'koneksi.php';

// Hapus data user jika parameter 'id' telah diterima
if (isset($_GET['id'])) {
    $id_obat = $_GET['id'];
    
    // Lakukan penghapusan data user dari database
    $hapus = mysqli_query($konek, "DELETE FROM tb_obat WHERE id_obat = '$id_obat'");
    
    if ($hapus) {
        echo "
        <script>
        alert('Data user berhasil dihapus');
        window.location.href='obat.php';
        </script>";
    } else {
        echo "
        <script>
        alert('Gagal menghapus data user');
        window.location.href='obat.php';
        </script>";
    }
} else {
    echo "
    <script>
    alert('ID user tidak ditemukan');
    window.location.href='obat.php';
    </script>";
}
?>
