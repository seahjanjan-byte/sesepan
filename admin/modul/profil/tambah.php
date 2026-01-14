<?php include '../../../config/config.php'; 
include 'cek_session.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Profil - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>
<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>
    <div class="content-main">
        <h3 class="fw-bold mb-4">Tambah Konten Profil Sekolah</h3>
        <div class="card-sesepan">
            <div class="card-header-blue text-white"><h5 class="mb-0">Form Profil</h5></div>
            <div class="p-4">
                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Kategori Profil</label>
                        <select name="judul" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Tentang Sekolah">Tentang Sekolah</option>
                            <option value="Visi dan Misi">Visi dan Misi</option>
                            <option value="Struktur Organisasi">Struktur Organisasi</option>
                            <option value="Sejarah Sekolah">Sejarah Sekolah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Konten</label>
                        <textarea name="isi" class="form-control" rows="8" placeholder="Tuliskan isi profil di sini..." required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Gambar Pendukung (Opsional)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <div class="form-text">*Sangat disarankan untuk Struktur Organisasi.</div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary shadow-sm">Batal</a>
                        <button type="submit" class="btn-primary-sesepan">Simpan Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>