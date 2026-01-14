<?php include '../../../config/config.php'; 
include 'cek_session.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Prestasi - Admin SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>

    <div class="content-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark m-0">Pengelolaan Prestasi</h3>
            <a href="tambah.php" class="btn-primary-sesepan text-decoration-none">
                <i class="bi bi-trophy-fill me-2"></i> Tambah Prestasi
            </a>
        </div>

        <div class="card-sesepan">
            <div class="card-header-blue">
                <h5 class="mb-0 fw-bold"><i class="bi bi-list-stars me-2"></i> Daftar Prestasi Sekolah</h5>
            </div>
            <div class="card-sesepan-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3" width="5%">No</th>
                                <th class="py-3" width="10%">Gambar</th>
                                <th class="py-3">Judul Prestasi</th>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3 text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM prestasi ORDER BY tgl_prestasi DESC");
                            while($d = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td class="px-4 fw-bold"><?= $no++; ?></td>
                                <td>
                                    <img src="../../../assets/img/<?= $d['gambar']; ?>" class="rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td class="fw-semibold"><?= $d['judul_prestasi']; ?></td>
                                <td><?= date('d/m/Y', strtotime($d['tgl_prestasi'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-warning px-3"><i class="bi bi-pencil-square"></i></a>
                                        <a href="proses.php?aksi=hapus&id=<?= $d['id']; ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Hapus prestasi ini?')"><i class="bi bi-trash"></i></a>
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
</body>
</html>