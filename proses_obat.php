<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {

  $nama_obat = $_POST['nama_obat'];
  $harga_obat = $_POST['harga'];
  $kategori = $_POST['kategori'];
  $satuan_obat = $_POST['satuan'];
  $stock_obat = $_POST['stock'];

  $kate = mysqli_query($konek, "SELECT id_kategori FROM tb_kategori WHERE kategori = '$kategori'");

  if ($kate) {
    $result = mysqli_fetch_assoc($kate);
    $id_kate = $result['id_kategori'];

    // Tambahkan data ke tabel 'tb_obat' setelah mendapatkan ID kategori
    $tambah = mysqli_query($konek, "INSERT INTO tb_obat (id_kategori, nama_obat, harga, satuan, stock) VALUES ('$id_kate', '$nama_obat', '$harga_obat', '$satuan_obat', '$stock_obat');");
  
    if ($tambah) {
      echo "
    <script>
      alert('Data telah disimpan');
      window.location.href='obat.php';
    </script>";
    } else {
      echo "
    <script>
      alert('Data gagal disimpan');
      window.location.href='obat.php';
    </script>";
    }
  } else {
    echo "
    <script>
      alert('Kategori tidak ditemukan');
      window.location.href='obat.php';
    </script>";
  }
}
// Edit
if (isset($_POST['ubah'])) {
  $id = $_POST['id_obat'];
  $nama_obat = $_POST['nama_obat'];
  $harga_obat = $_POST['harga'];
  $kategori = $_POST['kategori'];
  $satuan_obat = $_POST['satuan'];
  $stock_obat = $_POST['stock'];

  // Periksa nilai kategori yang diterima dari formulir edit
  echo "Nilai Kategori yang Diterima: $kategori<br>";

  // Query untuk memeriksa kategori yang dipilih
  $query_kategori = mysqli_query($konek, "SELECT id_kategori FROM tb_kategori WHERE kategori = '$kategori'");

  if ($query_kategori) {
      // Periksa apakah ada hasil dari query
      if (mysqli_num_rows($query_kategori) > 0) {
          // Ambil ID kategori dari hasil query
          $result_kategori = mysqli_fetch_assoc($query_kategori);
          $id_kategori = $result_kategori['id_kategori'];

          // Lakukan proses update data obat
          $update_obat = mysqli_query($konek, "UPDATE tb_obat SET nama_obat='$nama_obat', harga='$harga_obat', id_kategori='$id_kategori', satuan='$satuan_obat', stock='$stock_obat' WHERE id_obat = $id");

          if ($update_obat) {
              // Jika berhasil diupdate, kembalikan ke halaman obat.php
              echo "
                  <script>
                      alert('Data berhasil diubah');
                      window.location.href='obat.php';
                  </script>";
          } else {
              // Jika gagal mengupdate, tampilkan pesan error
              echo "
                  <script>
                      alert('Gagal mengubah data');
                      window.location.href='obat.php';
                  </script>";
          }
      } else {
          // Jika kategori tidak valid, tampilkan pesan error
          echo "
              <script>
                  alert('Kategori tidak valid');
                  window.location.href='obat.php';
              </script>";
      }
  } else {
      // Tampilkan pesan error jika query tidak berhasil dieksekusi
      die('Error: ' . mysqli_error($konek));
  }
}


?>
