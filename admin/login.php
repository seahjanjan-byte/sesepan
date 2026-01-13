<?php
session_start();
include '../config/config.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Sesuaikan query dengan nama tabel dan kolom di database kamu
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
        $_SESSION['admin_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        header("location:index.php");
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; }
        .card-login { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .login-header { background: #3b82f6; color: white; padding: 40px 20px; text-align: center; }
        .btn-login { background: #3b82f6; border: none; border-radius: 50px; padding: 12px; font-weight: bold; transition: 0.3s; }
        .btn-login:hover { background: #2563eb; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-login">
                <div class="login-header">
                    <i class="bi bi-shield-lock fs-1"></i>
                    <h4 class="mt-2 fw-bold">Admin Login</h4>
                    <p class="small mb-0 opacity-75">SDN Sesepan Dashboard</p>
                </div>
                <div class="card-body p-4">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger small py-2 text-center"><?= $error; ?></div>
                    <?php endif; ?>
                    
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Username</label>
                            <input type="text" name="username" class="form-control rounded-pill px-3" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control rounded-pill px-3" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100 btn-login shadow-sm">
                            Masuk Ke Panel <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="../index.php" class="text-muted text-decoration-none small"><i class="bi bi-house-door"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>