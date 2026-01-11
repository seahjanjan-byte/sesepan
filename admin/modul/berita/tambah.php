<?php 
include '../../../config/config.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Berita - SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Berita Baru</h4>
            </div>
            <div class="card-body p-4">
                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul berita..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Berita</label>
                        <textarea name="isi" class="form-control" rows="8" placeholder="Tuliskan detail berita di sini..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar Sampul</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <div class="form-text text-muted">Format: JPG, PNG, atau WebP. Maks 2MB.</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" name="simpan" class="btn btn-primary">Posting Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>