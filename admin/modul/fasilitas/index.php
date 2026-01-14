<?php include '../../../config/config.php'; 
include 'cek_session.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Fasilitas - Admin SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>

    <div class="content-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark m-0">Fasilitas Sekolah</h3>
            <a href="tambah.php" class="btn-primary-sesepan text-decoration-none">
                <i class="bi bi-plus-lg me-2"></i> Tambah Fasilitas
            </a>
        </div>

        <div class="card-sesepan">
            <div class="card-header-blue">
                <h5 class="mb-0 fw-bold"><i class="bi bi-building me-2"></i> Daftar Fasilitas Sekolah</h5>
            </div>
            <div class="card-sesepan-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3" width="5%">No</th>
                                <th class="py-3" width="15%">Gambar</th>
                                <th class="py-3">Nama Fasilitas</th>
                                <th class="py-3 text-center" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM fasilitas ORDER BY id DESC");
                            while($d = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td class="px-4 fw-bold"><?= $no++; ?></td>
                                <td>
                                    <img src="../../../assets/img/<?= $d['gambar']; ?>" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="fw-semibold text-capitalize"><?= $d['nama_fasilitas']; ?></td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-warning px-3">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="proses.php?aksi=hapus&id=<?= $d['id']; ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Hapus fasilitas ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>