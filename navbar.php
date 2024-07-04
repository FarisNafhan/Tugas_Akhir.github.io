<?php
include "koneksi.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <?php if ($_SESSION['level'] == "Karyawan") { ?>
            <li class="nav-item">
              <a class="nav-link" href="transaksi.php">Draft Transaksi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="detail_transaksi.php?id_transaksi=<?php echo isset($_SESSION['id_transaksi_terakhir']) ? $_SESSION['id_transaksi_terakhir'] : ''; ?>">Detail Transaksi Terakhir</a>
            </li>
          <?php }
          if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Karyawan") { ?>
            <li class="nav-item">
              <a class="nav-link" href="obat.php">Obat</a>
            </li>
          <?php }
          if ($_SESSION['level'] == "Admin"){ ?>
            <li class="nav-item">
              <a class="nav-link" href="stock.php">Stock</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kategori.php">Kategori</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="user.php">User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="role.php">Role</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="laporan.php">Laporan</a>
            </li>
          <?php } ?>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>