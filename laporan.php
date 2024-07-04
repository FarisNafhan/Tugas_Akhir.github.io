<?php
include('koneksi.php');

// Query untuk mengambil data transaksi
$sql = "SELECT t.id_transaksi, t.tanggal, u.nama AS kasir, t.total_harga 
        FROM tb_transaksi t 
        JOIN tb_user u ON t.id_user = u.id_user 
        ORDER BY t.id_transaksi DESC";
$result = $konek->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            margin-top: 20px;
        }
        th {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-4">
        <div class="table-container">
            <h2 class="mb-4">Laporan Transaksi</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_transaksi']; ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo $row['kasir']; ?></td>
                            <td><?php echo $row['total_harga']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi database
$konek->close();
?>
