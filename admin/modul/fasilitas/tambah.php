<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <title>Tambah Fasilitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white"><h4>Tambah Fasilitas Baru</h4></div>
            <div class="card-body">
                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nama Fasilitas</label>
                        <input type="text" name="nama_fasilitas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Fasilitas</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>