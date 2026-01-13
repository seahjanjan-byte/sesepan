<?php 
include '../../../config/config.php'; 
$sql = mysqli_query($conn, "SELECT * FROM profil WHERE kategori='tentang'");
$d = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Tentang Sekolah - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>
<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>
    <div class="content-main">
        <h3 class="fw-bold mb-4">Ubah Tentang Sekolah</h3>
        <div class="card-sesepan">
            <div class="card-header-blue text-white"><h5 class="mb-0">Formulir Edit Teks</h5></div>
            <div class="p-4">
                <form action="proses.php" method="POST">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Isi Tentang Sekolah (Hanya Teks)</label>
                        <textarea name="isi" class="form-control" rows="12" required><?= $d['isi']; ?></textarea>
                        <div class="form-text mt-2 text-primary small">*Gunakan enter untuk membuat baris baru.</div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" name="update" class="btn-primary-sesepan">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>