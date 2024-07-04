<?php
session_start();
include('koneksi.php');

// Tangani penyimpanan transaksi baru
if (isset($_POST['simpan_transaksi_modal'])) {
    $kasir = $_POST['kasir'];
    $nominal = $_POST['nominal'];
    $tanggal = $_POST['tanggal'];
    $total_harga = $_POST['total_harga'];

    // Periksa apakah nominal cukup untuk total harga
    if ($nominal < $total_harga) {
        $_SESSION['error'] = "Nominal tidak cukup untuk membayar total harga.";
        header("Location: transaksi.php");
        exit();
    }

    // Cari ID user dari nama kasir
    $sql_check_user = "SELECT id_user FROM tb_user WHERE nama = ?";
    $stmt_check_user = $konek->prepare($sql_check_user);
    $stmt_check_user->bind_param("s", $kasir);
    $stmt_check_user->execute();
    $result_check_user = $stmt_check_user->get_result();

    if ($result_check_user->num_rows > 0) {
        $row_user = $result_check_user->fetch_assoc();
        $id_user = $row_user['id_user'];
    } else {
        $_SESSION['error'] = "ID User (kasir) tidak valid.";
        header("Location: transaksi.php");
        exit();
    }

    // Simpan data transaksi ke database
    $sql_transaksi = "INSERT INTO tb_transaksi (tanggal, kasir, total_harga, id_user) VALUES (?, ?, ?, ?)";
    $stmt_transaksi = $konek->prepare($sql_transaksi);
    $stmt_transaksi->bind_param("ssii", $tanggal, $kasir, $total_harga, $id_user);

    if ($stmt_transaksi->execute()) {
        $id_transaksi = $stmt_transaksi->insert_id;

        // Simpan detail transaksi ke database
        if (isset($_SESSION['transaksi'])) {
            foreach ($_SESSION['transaksi'] as $item) {
                $id_obat = $item['id_obat'];
                $jumlah = $item['jumlah'];
                $harga_satuan = $item['harga'];

                $sql_detail = "INSERT INTO tb_detail_transaksi (id_transaksi, id_obat, jumlah, harga_satuan) VALUES (?, ?, ?, ?)";
                $stmt_detail = $konek->prepare($sql_detail);
                $stmt_detail->bind_param("iiid", $id_transaksi, $id_obat, $jumlah, $harga_satuan);
                $stmt_detail->execute();
            }
        }

        // Hitung kembalian
        $kembalian = $nominal - $total_harga;
        $_SESSION['kembalian'] = $kembalian;

        // Hapus keranjang
        unset($_SESSION['transaksi']);

        // Simpan ID transaksi terakhir ke sesi
        $_SESSION['id_transaksi_terakhir'] = $id_transaksi;

        // Redirect kembali ke halaman transaksi
        header("Location: transaksi.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal menyimpan transaksi.";
        header("Location: transaksi.php");
        exit();
    }
}

// Tangani penambahan obat ke keranjang
if (isset($_POST['pilih'])) {
    $id_obat = $_POST['id_obat'];
    $jumlah = $_POST['jumlah'];

    // Ambil data obat dari database
    $sql_obat = "SELECT * FROM tb_obat WHERE id_obat = '$id_obat'";
    $result_obat = $konek->query($sql_obat);
    if ($result_obat->num_rows > 0) {
        $obat = $result_obat->fetch_assoc();

        $item = [
            'id_obat' => $id_obat,
            'nama_obat' => $obat['nama_obat'],
            'harga' => $obat['harga'],
            'jumlah' => $jumlah,
        ];

        // Tambahkan item ke keranjang
        $_SESSION['transaksi'][] = $item;
    }

    header("Location: transaksi.php");
    exit();
}

// Tangani penghapusan item dari keranjang
if (isset($_POST['hapus'])) {
    $index = $_POST['index'];
    unset($_SESSION['transaksi'][$index]);

    header("Location: transaksi.php");
    exit();
}
?>
