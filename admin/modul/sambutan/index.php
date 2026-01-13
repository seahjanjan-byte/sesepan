<?php 
include '../../../config/config.php'; 
// Mengambil data sambutan
$query = mysqli_query($conn, "SELECT * FROM profil WHERE kategori='sambutan' LIMIT 1");
$d = mysqli_fetch_array($query);
if (!$d) {
    $d = [
        'id' => '',
        'isi' => 'Data belum ada, silakan isi sambutan baru.',
        'gambar' => 'default.jpg'
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Sambutan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>
<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>
    <div class="content-main">
        <div class="card-sesepan">
            <div class="card-header-blue">
                <h5><i class="bi bi-person-badge me-2"></i> Edit Sambutan Kepala Sekolah</h5>
            </div>
            <div class="card-body p-4">
                <form action="proses.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $d['id']; ?>">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <label class="fw-bold d-block mb-3">Foto Kepala Sekolah</label>
                            <img src="../../../assets/img/<?= $d['gambar']; ?>" class="img-fluid rounded-4 shadow-sm border mb-3">
                            <input type="file" name="gambar" class="form-control rounded-pill">
                        </div>
                        <div class="col-md-8">
                            <label class="fw-bold mb-2">Teks Sambutan</label>
                            <textarea name="isi" class="form-control rounded-4" rows="12"><?= $d['isi']; ?></textarea>
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="submit" name="update" class="btn-primary-sesepan px-5">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>