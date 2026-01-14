<?php include '../../../config/config.php';
include '../../cek_session.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola PPDB - Admin SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>

    <div class="content-main">
        <h3 class="fw-bold text-dark mb-4">Pengaturan PPDB</h3>

        <?php
        // Mengambil data tunggal PPDB
        $sql = mysqli_query($conn, "SELECT * FROM ppdb LIMIT 1");
        $d = mysqli_fetch_array($sql);
        ?>

        <div class="card-sesepan">
            <div class="card-header-blue text-white">
                <h5 class="mb-0 fw-bold"><i class="bi bi-mortarboard me-2"></i> Status Pendaftaran & Brosur</h5>
            </div>
            <div class="card-sesepan-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-5 text-center border-end">
                        <label class="fw-bold d-block mb-3">Brosur Saat Ini</label>
                        <?php if($d): ?>
                            <img src="../../../assets/img/<?= $d['gambar']; ?>" class="img-fluid rounded shadow-sm border mb-3" style="max-height: 350px;">
                            <div class="mt-2">
                                <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-warning w-100 rounded-pill fw-bold">
                                    <i class="bi bi-image me-2"></i> Ganti Gambar Brosur
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="py-5 bg-light rounded border mb-3 text-muted">Belum ada brosur</div>
                            <a href="tambah.php" class="btn btn-primary w-100 rounded-pill">Upload Brosur Pertama</a>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-7 ps-md-5">
                        <label class="fw-bold d-block mb-3">Status Pendaftaran Sekarang:</label>
                        
                        <?php if($d && $d['status'] == 'buka'): ?>
                            <div class="alert alert-success d-flex align-items-center mb-4">
                                <i class="bi bi-check-circle-fill fs-3 me-3"></i>
                                <div><strong>AKTIF:</strong> Pendaftaran sedang dibuka dan brosur tampil di website.</div>
                            </div>
                            <a href="proses.php?aksi=status&id=<?= $d['id']; ?>&set=tutup" class="btn btn-danger btn-lg w-100 rounded-4 py-3 shadow">
                                <i class="bi bi-x-circle me-2"></i> Tutup Pendaftaran Sekarang
                            </a>
                        <?php elseif($d && $d['status'] == 'tutup'): ?>
                            <div class="alert alert-danger d-flex align-items-center mb-4">
                                <i class="bi bi-info-circle-fill fs-3 me-3"></i>
                                <div><strong>NON-AKTIF:</strong> Pendaftaran ditutup. Pengunjung akan melihat pesan pemberitahuan.</div>
                            </div>
                            <a href="proses.php?aksi=status&id=<?= $d['id']; ?>&set=buka" class="btn btn-success btn-lg w-100 rounded-4 py-3 shadow">
                                <i class="bi bi-check-circle me-2"></i> Buka Pendaftaran Sekarang
                            </a>
                        <?php endif; ?>
                        
                        <div class="mt-4 p-3 bg-light rounded border small text-muted">
                            <i class="bi bi-lightbulb me-2"></i> <strong>Tips:</strong> Pastikan gambar brosur yang diunggah memiliki kualitas yang jelas agar mudah dibaca oleh calon wali murid.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>