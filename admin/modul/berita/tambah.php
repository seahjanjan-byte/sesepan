<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Berita - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .custom-card { background-color: #fdf8ee; border: none; border-radius: 15px; padding: 30px; }
        .btn-save { background-color: #1e3a5f; color: white; border-radius: 10px; padding: 10px 25px; border: none; }
        .btn-back { background-color: #6c757d; color: white; border-radius: 10px; padding: 10px 25px; text-decoration: none; }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include '../../sidebar.php'; ?>

    <div class="content-main">
        <div class="p-4 bg-white border-bottom shadow-sm">
            <h4 class="fw-bold mb-0 text-dark">Tambah Berita</h4>
        </div>

        <div class="p-5">
            <div class="custom-card shadow-sm">
                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Berita</label>
                        <input type="text" name="judul" class="form-control shadow-sm" style="border-radius: 8px;" placeholder="Masukkan judul..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Berita</label>
                        <textarea name="isi" class="form-control shadow-sm" style="border-radius: 8px;" rows="8" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Gambar Sampul</label>
                        <input type="file" name="gambar" class="form-control shadow-sm" style="border-radius: 8px;">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn-back shadow-sm">Kembali</a>
                        <button type="submit" class="btn-save shadow-sm">Posting Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>