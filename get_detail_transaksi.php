<?php
include('koneksi.php');

if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $konek->real_escape_string($_GET['id_transaksi']);

    // Query untuk mendapatkan detail transaksi
    $sql_detail = "SELECT dt.id_detail, dt.id_transaksi, dt.id_obat, dt.jumlah, dt.harga_satuan, o.nama_obat 
                   FROM tb_detail_transaksi dt
                   JOIN tb_obat o ON dt.id_obat = o.id_obat
                   WHERE dt.id_transaksi = '$id_transaksi'";
    $result_detail = $konek->query($sql_detail);

    if ($result_detail && $result_detail->num_rows > 0) {
        $detail_transaksi = [];
        $subtotal = 0;

        while ($row = $result_detail->fetch_assoc()) {
            $total_harga = $row['jumlah'] * $row['harga_satuan'];
            $subtotal += $total_harga;
            $detail_transaksi[] = $row;
        }

        // Query untuk mendapatkan kasir dari transaksi
        $sql_kasir = "SELECT kasir FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'";
        $result_kasir = $konek->query($sql_kasir);
        $kasir = $result_kasir->fetch_assoc()['kasir'];

        // Menggabungkan data detail transaksi dengan subtotal dan kasir dalam bentuk JSON
        $response = [
            'detail' => $detail_transaksi,
            'subtotal' => $subtotal,
            'kasir' => $kasir
        ];

        // Mengembalikan response dalam format JSON
        echo json_encode($response);
    } else {
        // Memberikan pesan jika data detail transaksi tidak ditemukan
        echo json_encode(['error' => 'Data detail transaksi tidak ditemukan']);
    }
} else {
    // Memberikan pesan jika ID Transaksi tidak valid
    echo json_encode(['error' => 'ID Transaksi tidak valid']);
}
?>
