<?php include '../../../config/config.php'; 
include 'cek_session.php';?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Guru - Admin SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>

    <div class="content-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark m-0">Data Tenaga Pengajar</h3>
            <a href="tambah.php" class="btn-primary-sesepan text-decoration-none">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Guru
            </a>
        </div>

        <div class="card-sesepan">
            <div class="card-header-blue">
                <h5 class="mb-0 fw-bold"><i class="bi bi-people-fill me-2"></i> Daftar Guru SDN Sesepan</h5>
            </div>
            <div class="card-sesepan-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3" width="5%">No</th>
                                <th class="py-3" width="10%">Foto</th>
                                <th class="py-3">Nama Lengkap</th>
                                <th class="py-3">Jabatan</th>
                                <th class="py-3 text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM guru ORDER BY id DESC");
                            if(mysqli_num_rows($sql) == 0) {
                                echo "<tr><td colspan='5' class='text-center py-4 text-muted small'>Belum ada data guru.</td></tr>";
                            }
                            while($d = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td class="px-4 fw-bold"><?= $no++; ?></td>
                                <td>
                                    <img src="../../../assets/img/<?= $d['foto']; ?>" class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #e2e8f0;">
                                </td>
                                <td class="fw-semibold"><?= $d['nama']; ?></td>
                                <td><span class="badge bg-secondary rounded-pill px-3"><?= $d['jabatan']; ?></span></td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-warning px-3"><i class="bi bi-pencil-square"></i></a>
                                        <a href="proses.php?aksi=hapus&id=<?= $d['id']; ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Hapus data guru ini?')"><i class="bi bi-trash"></i></a>
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