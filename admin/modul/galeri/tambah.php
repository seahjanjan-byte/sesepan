<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Galeri - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>
<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>
    <div class="content-main">
        <h3 class="fw-bold mb-4">Tambah Dokumentasi Baru</h3>
        <div class="card-sesepan">
            <div class="card-header-blue text-white"><h5 class="mb-0">Form Galeri</h5></div>
            <div class="p-4">
                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Kegiatan</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Lomba 17 Agustus 2025" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="kategori" class="form-select" id="kategori" required>
                                <option value="foto">Foto</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tipe Sumber</label>
                            <select name="tipe_sumber" class="form-select" id="tipe_sumber" required>
                                <option value="upload">Upload File (Lokal)</option>
                                <option value="link_drive">Link Google Drive</option>
                                <option value="link_youtube">Link YouTube (Hanya Video)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4" id="input_sumber">
                        <label class="form-label fw-bold" id="label_sumber">Pilih File</label>
                        <input type="file" name="file_sumber" id="file_input" class="form-control">
                        <input type="text" name="url_sumber" id="url_input" class="form-control d-none" placeholder="Tempel link di sini...">
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary shadow-sm">Batal</a>
                        <button type="submit" class="btn-primary-sesepan">Simpan Media</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Script sederhana untuk ubah input berdasarkan tipe sumber
const tipe = document.getElementById('tipe_sumber');
const fileInput = document.getElementById('file_input');
const urlInput = document.getElementById('url_input');
const label = document.getElementById('label_sumber');

tipe.addEventListener('change', function() {
    if(this.value === 'upload') {
        fileInput.classList.remove('d-none');
        urlInput.classList.add('d-none');
        label.innerText = "Pilih File";
    } else {
        fileInput.classList.add('d-none');
        urlInput.classList.remove('d-none');
        label.innerText = "Masukkan URL / Link";
    }
});
</script>
</body>
</html>