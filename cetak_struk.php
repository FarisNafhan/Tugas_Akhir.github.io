<?php
include('koneksi.php');

$id_transaksi = $_GET['id_transaksi'] ?? null;

if (!$id_transaksi) {
    die("ID transaksi tidak tersedia.");
}

$sql = "SELECT t.id_transaksi, t.tanggal, t.kasir, t.total_harga, dt.jumlah, dt.harga_satuan, o.nama_obat 
        FROM tb_transaksi t 
        JOIN tb_detail_transaksi dt ON t.id_transaksi = dt.id_transaksi 
        JOIN tb_obat o ON dt.id_obat = o.id_obat 
        WHERE t.id_transaksi = '$id_transaksi'";
$result = $konek->query($sql);

if ($result === false) {
    die("Error executing query: " . $konek->error);
}

if ($result->num_rows > 0) {
    // Data transaksi ditemukan
    $transaksi = $result->fetch_assoc();
    $tanggal = $transaksi["tanggal"];
    $kasir = $transaksi["kasir"];
    $total_harga = $transaksi["total_harga"];

    // Reset pointer result set
    $result->data_seek(0);

    // Output struk cetak dalam format HTML
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Struk Cetak Transaksi</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
            }
            .container {
                width: 300px;
                margin: auto;
                border: 1px solid #ccc;
                padding: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            .header {
                text-align: center;
                margin-bottom: 10px;
            }
            .content {
                margin-bottom: 10px;
            }
            .table {
                width: 100%;
                border-collapse: collapse;
            }
            .table th, .table td {
                border: 1px solid #ddd;
                padding: 8px;
            }
            .total {
                margin-top: 10px;
                text-align: right;
            }
            .print-button {
                text-align: center;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Struk Cetak Transaksi</h2>
                <p>Tanggal: <?php echo $tanggal; ?></p>
            </div>
            <div class="content">
                <p><strong>ID Transaksi:</strong> <?php echo $transaksi['id_transaksi']; ?></p>
                <p><strong>Kasir:</strong> <?php echo $kasir; ?></p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row["nama_obat"]; ?></td>
                                <td><?php echo $row["jumlah"]; ?></td>
                                <td>Rp <?php echo number_format($row["harga_satuan"], 0, ',', '.'); ?></td>
                                <td>Rp <?php echo number_format($row["jumlah"] * $row["harga_satuan"], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="total">
                <p><strong>Total Harga:</strong> Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></p>
            </div>
        </div>
        <div class="print-button">
            <button onclick="cetakStruk()">Cetak Struk</button>
        </div>

        <script>
            function cetakStruk() {
                var originalContents = document.body.innerHTML; // Simpan konten asli halaman
                window.print(); // Lakukan pencetakan
                document.body.innerHTML = originalContents; // Kembalikan konten halaman ke aslinya
                window.location.reload(); // Refresh halaman (opsional)
            }
        </script>

    </body>
    </html>

    <?php
} else {
    echo "Tidak ada data transaksi.";
}

$konek->close();
?>
