<?php 
include '../../../config/config.php'; 
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM prestasi WHERE id='$id'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Prestasi - Admin SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>
<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>
    <div class="content-main">
        <h3 class="fw-bold mb-4">Edit Data Prestasi</h3>
        <div class="card-sesepan">
            <div class="card-header-blue">
                <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> Perbarui Data</h5>
            </div>
            <div class="card-sesepan-body p-4">
                <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Prestasi</label>
                                <input type="text" name="judul_prestasi" class="form-control" value="<?= $data['judul_prestasi']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Prestasi</label>
                                <input type="date" name="tgl_prestasi" class="form-control" value="<?= $data['tgl_prestasi']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-label fw-bold d-block">Gambar Saat Ini</label>
                            <img src="../../../assets/img/<?= $data['gambar']; ?>" class="rounded shadow-sm border mb-2" style="max-height: 120px;">
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="mb-4 mt-3">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="5" required><?= $data['keterangan']; ?></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn-secondary-sesepan text-decoration-none">Batal</a>
                        <button type="submit" class="btn-primary-sesepan">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>