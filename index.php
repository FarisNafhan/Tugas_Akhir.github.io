<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan CSS tambahan di sini jika diperlukan */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 300px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .card-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['cek'])) {
        if ($_GET['cek'] == "gagal") {
            echo "<div class='alert alert-danger' role='alert'>Username dan Password tidak sesuai</div>";
        }
    }
    ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Login</h3>
            </div>
            <form action="cek_login.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>   
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-login" name="login" value="Login">
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JavaScript dan dependensi Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
