<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan CSS tambahan di sini jika diperlukan */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .btn-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            background-color: #fff;
            text-align: left;
            padding: 20px;
            width: 100%;
        }
        .btn-card:hover {
            transform: scale(1.05);
        }
        .btn-card:focus {
            outline: none;
        }
        .btn-card h5 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .btn-card p {
            font-size: 1rem;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; 
    if ($_SESSION['level'] == "") {
        header("location:index.php?cek=gagal");
    }
    ?>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3" style="width: 35rem">
                <button type="button" class="btn btn-card">
                    <h5>Data Produk</h5>
                    <p>Kelola data produk obat.</p>
                </button>
            </div>
            <div class="col-md-4 mb-3" style="width: 35rem">
                <button type="button" class="btn btn-card">
                    <h5>Data Pengguna</h5>
                    <p>Kelola data pengguna.</p>
                </button>
            </div>
            <div class="col-md-4 mb-3" style="width: 70rem">
                <button type="button" class="btn btn-card">
                    <h5>Laporan Penjualan</h5>
                    <p>Lihat laporan penjualan obat.</p>
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript dan dependensi Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
