<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Tentang Sekolah - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>

    <div class="content-main">
        <h3 class="fw-bold m-0 mb-4">Kelola Tentang Sekolah</h3>

        <?php
        $sql = mysqli_query($conn, "SELECT * FROM profil WHERE kategori='tentang'");
        $d = mysqli_fetch_array($sql);
        ?>

        <div class="card border=0 shadow-sm  rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-card-text me-2"></i> Konten Teks Tentang Sekolah</h5>
            </div>
            <div class="card-body p-4">
                <label class="fw-bold text-muted mb-3">Isi Saat Ini:</label>
                
                <div class="p-4 bg-light border border-primary rounded-3 mb-4" style="min-height: 200px; line-height: 1.8;">
                    <?php 
                    if ($d) {
                        echo nl2br($d['isi']); 
                    } else {
                        echo "<em class='text-muted'>Data belum diinput.</em>";
                    }
                    ?>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="../profil/index.php" class="btn btn-secondary px-4 fw-bold rounded-pill shadow-sm">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                    <a href="edit.php" class="btn btn-warning px-4 fw-bold rounded-pill shadow-sm">
                        <i class="bi bi-pencil-square me-2"></i> Edit Teks Tentang Sekolah
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>