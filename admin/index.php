<?php include '../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>

<div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="content-main">
        <h2>Selamat Datang, Admin!</h2>
        <p>Gunakan menu di samping untuk mengelola konten website SDN Sesepan.</p>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white p-3">
                    <h5>Total Berita</h5>
                    <h3>5</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white p-3">
                    <h5>Total Fasilitas</h5>
                    <h3>12</h3>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>