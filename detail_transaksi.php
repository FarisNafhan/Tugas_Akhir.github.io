<?php
include('koneksi.php');

// Mendapatkan semua transaksi
$sql = "SELECT t.id_transaksi, t.tanggal, t.kasir, t.total_harga
        FROM tb_transaksi t";
$result = $konek->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Semua Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h3>Detail Semua Transaksi</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th>Total Harga</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_transaksi']; ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo $row['kasir']; ?></td>
                            <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td><button class="btn btn-primary" onclick="viewDetails('<?php echo $row['id_transaksi']; ?>')">Detail</button></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan detail transaksi -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Detail transaksi akan dimuat di sini -->
                    <div id="detailContent"></div>
                    <div class="mt-3">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan="4"><strong>Total Harga</strong></td>
                                    <td>:</td>
                                    <td id="subtotal"></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><strong>Kasir</strong></td>
                                    <td>:</td>
                                    <td id="kasir"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <!-- Bagian button cetak struk di dalam modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="cetakStruk()">Cetak Struk</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script untuk AJAX -->
<!-- Script untuk AJAX -->
<script>
    function viewDetails(id_transaksi) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "get_detail_transaksi.php?id_transaksi=" + id_transaksi, true);
        xhr.onload = function () {
            if (this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const detailContent = document.getElementById('detailContent');
                    detailContent.innerHTML = ''; // Mengosongkan konten sebelum memuat baru

                    // Membuat tabel HTML untuk detail transaksi
                    let tableHTML = '<table class="table">';
                    tableHTML += '<thead><tr><th>ID Detail</th><th>ID Transaksi</th><th>ID Obat</th><th>Nama Obat</th><th>Jumlah</th><th>Harga Satuan</th><th>Total Harga</th></tr></thead>';
                    tableHTML += '<tbody>';
                    
                    // Loop untuk menambahkan baris detail transaksi
                    data.detail.forEach(item => {
                        tableHTML += '<tr>';
                        tableHTML += '<td>' + item.id_detail + '</td>';
                        tableHTML += '<td>' + item.id_transaksi + '</td>';
                        tableHTML += '<td>' + item.id_obat + '</td>';
                        tableHTML += '<td>' + item.nama_obat + '</td>';
                        tableHTML += '<td>' + item.jumlah + '</td>';
                        tableHTML += '<td>Rp ' + item.harga_satuan.toLocaleString() + '</td>';
                        tableHTML += '<td>Rp ' + (item.jumlah * item.harga_satuan).toLocaleString() + '</td>';
                        tableHTML += '</tr>';
                    });

                    tableHTML += '</tbody></table>';

                    // Memasukkan tabel HTML ke dalam modal
                    detailContent.innerHTML = tableHTML;

                    // Menampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('modalDetail'));
                    modal.show();

                    // Memasukkan subtotal dan kasir ke dalam modal
                    document.getElementById('subtotal').textContent = 'Rp ' + data.subtotal.toLocaleString();
                    document.getElementById('kasir').textContent = data.kasir;

                    // Menyimpan ID transaksi di dalam modal untuk cetak struk
                    document.getElementById('modalDetail').setAttribute('data-id_transaksi', id_transaksi);
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                }
            } else {
                console.error('Failed to fetch data:', this.status);
            }
        };
        xhr.send();
    }

    function cetakStruk() {
        const id_transaksi = document.getElementById('modalDetail').getAttribute('data-id_transaksi');
        window.open('cetak_struk.php?id_transaksi=' + id_transaksi, '_blank');
    }
</script>


</body>
</html>
