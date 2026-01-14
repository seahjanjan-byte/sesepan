<?php 
include '../../../config/config.php'; 
include '../../cek_session.php'; ;
$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM galeri WHERE id='$id'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Galeri - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>
<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>
    <div class="content-main">
        <h3 class="fw-bold mb-4">Edit Dokumentasi</h3>
        <div class="card-sesepan">
            <div class="card-header-blue text-white"><h5 class="mb-0">Ubah Data Media</h5></div>
            <div class="p-4">
                <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $d['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Kegiatan</label>
                        <input type="text" name="judul" class="form-control" value="<?= $d['judul']; ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Sumber Saat Ini</label>
                        <p class="small text-truncate border p-2 bg-light"><?= $d['sumber']; ?></p>
                        <label class="form-label fw-bold">Ubah Sumber (Jika Perlu)</label>
                        <input type="text" name="url_sumber" class="form-control" placeholder="Masukkan link baru jika ingin diubah...">
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn-primary-sesepan">Update Media</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>