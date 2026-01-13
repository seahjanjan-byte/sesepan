<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Guru - SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; margin: 0; }
        .content-main { margin-left: 250px; width: calc(100% - 250px); min-height: 100vh; }
        /* Warna Krem untuk Kartu Konten */
        .custom-card { background-color: #fdfdfb; border: none; border-radius: 15px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .btn-save { background-color: #1abc9c; color: white; border: none; border-radius: 8px; padding: 10px 20px; }
        .btn-save:hover { background-color: #16a085; }
    </style>
</head>
<body>
<div class="d-flex">
    <?php include '../../sidebar.php'; ?>
    <div class="content-main">
        <div class="p-4 bg-white border-bottom shadow-sm">
            <h4 class="fw-bold mb-0">Tambah Data Guru Baru</h4>
        </div>
        <div class="p-5">
            <div class="custom-card">
                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama dan Gelar..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Guru Kelas 1" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto Guru</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" class="btn-save shadow-sm">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>