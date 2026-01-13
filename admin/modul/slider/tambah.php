<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Slider - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body style="background-color: #f8f9fa;">
<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>
    <div class="content-main">
        <h3 class="fw-bold mb-4">Tambah Slider Baru</h3>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold">Form Slider</h5>
            </div>
            <div class="card-body p-4">
                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Utama</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Selamat Datang di SDN Sesepan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Subjudul / Keterangan</label>
                        <input type="text" name="subjudul" class="form-control" placeholder="Contoh: Sekolah Berkarakter dan Berprestasi" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Pilih Gambar Slider</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                        <small class="text-muted">*Rekomendasi ukuran: 1920x800 pixel.</small>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary px-4 rounded-pill">Batal</a>
                        <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm">Simpan Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>