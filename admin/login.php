<?php include 'cek_session.php'; // Sesuaikan pathnya jika berada di dalam folder modul ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(rgba(13, 110, 253, 0.8), rgba(13, 110, 253, 0.8)), 
                        url('../assets/img/school.jpg') center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="login-box text-center">
        <img src="../assets/img/logoo.png" width="70" class="mb-3">
        <h4 class="fw-bold">Admin Login</h4>
        <p class="text-muted small">SDN Sesepan Dashboard</p>
        
        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') echo "<div class='alert alert-danger py-2 small'>Login Gagal! Cek kembali data Anda.</div>"; ?>

        <form action="proses_login.php" method="POST" class="text-start mt-4">
            <div class="mb-3">
                <label class="form-label small fw-bold">Username</label>
                <input type="text" name="username" class="form-control rounded-pill px-3" placeholder="Masukkan username" required>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold">Password</label>
                <input type="password" name="password" class="form-control rounded-pill px-3" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Masuk Ke Panel <i class="bi bi-arrow-right ms-2"></i></button>
        </form>
        <a href="../index.php" class="d-block mt-4 text-decoration-none small text-muted"><i class="bi bi-house me-1"></i> Kembali ke Beranda</a>
    </div>
</body>
</html>