<?php
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h3>Transaksi</h3>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <form method="post" action="proses_transaksi.php">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="id_obat" class="form-label">Pilih Obat</label>
                            <select class="form-select" id="id_obat" name="id_obat" required>
                                <option selected disabled>-- Pilih Obat --</option>
                                <?php
                                $sql = "SELECT id_obat, nama_obat FROM tb_obat";
                                $result = mysqli_query($konek, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id_obat']}'>{$row['nama_obat']}</option>";
                                    }
                                } else {
                                    echo "<option disabled>Tidak ada obat</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" name="pilih">Tambahkan ke Keranjang</button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_harga = 0;
                if (isset($_SESSION['transaksi'])) {
                    foreach ($_SESSION['transaksi'] as $index => $item) {
                        $total_item = $item['harga'] * $item['jumlah'];
                        $total_harga += $total_item;
                        echo "<tr>";
                        echo "<td>{$item['id_obat']}</td>";
                        echo "<td>{$item['nama_obat']}</td>";
                        echo "<td>{$item['harga']}</td>";
                        echo "<td>{$item['jumlah']}</td>";
                        echo "<td>{$total_item}</td>";
                        echo "<td><form method='post' action='proses_transaksi.php'>";
                        echo "<input type='hidden' name='index' value='{$index}'>";
                        echo "<button type='submit' name='hapus' class='btn btn-danger'>Hapus</button>";
                        echo "</form></td>";
                        echo "</tr>";
                    }
                }
                ?>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total Harga:</strong></td>
                    <td><?php echo $total_harga; ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="row mt-4">
            <div class="col-md-12">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSimpanTransaksi">
                    Simpan Transaksi
                </button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <?php
                if (isset($_SESSION['kembalian'])) {
                    echo "<div class='alert alert-success'>Transaksi berhasil! Kembalian: Rp {$_SESSION['kembalian']}</div>";
                    unset($_SESSION['kembalian']);
                } elseif (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
                    unset($_SESSION['error']);
                }
                ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSimpanTransaksi" tabindex="-1" aria-labelledby="modalSimpanTransaksiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSimpanTransaksiLabel">Simpan Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="proses_transaksi.php">
                        <div class="mb-3">
                            <label for="kasir" class="form-label">Kasir</label>
                            <input type="text" class="form-control" id="kasir" name="kasir" value="<?php echo $_SESSION['nama']; ?>" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal</label>
                            <input type="number" class="form-control" id="nominal" name="nominal" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <input type="hidden" name="total_harga" value="<?php echo $total_harga; ?>">
                        <button type="submit" name="simpan_transaksi_modal" class="btn btn-success">Simpan Transaksi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#modalSimpanTransaksi').on('hidden.bs.modal', function () {
                $(this).data('bs.modal', null);
            });
        });
    </script>
</body>
</html>
