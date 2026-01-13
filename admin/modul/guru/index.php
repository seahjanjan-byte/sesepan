<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Guru - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .custom-card { background-color: #fdfdfb; border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .btn-add { background-color: #1e3a5f; color: white; border-radius: 20px; padding: 8px 20px; text-decoration: none; }
        .img-guru { width: 60px; height: 60px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include '../../sidebar.php'; ?> <div class="content-main">
        <div class="p-4 bg-white border-bottom">
            <h4 class="fw-bold mb-0 text-dark">Data Guru</h4>
        </div>

        <div class="p-4">
            <div class="card custom-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Daftar Guru SDN Sesepan</h5>
                    <a href="tambah.php" class="btn-add btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Guru
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-muted">
                                <th width="5%">No</th>
                                <th width="10%">Foto</th>
                                <th width="40%">Nama Lengkap</th>
                                <th width="25%">Jabatan</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM guru ORDER BY id DESC");
                            while($d = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td class="fw-bold"><?= $no++; ?></td>
                                <td><img src="../../../assets/img/<?= $d['foto']; ?>" class="img-guru"></td>
                                <td class="fw-semibold"><?= $d['nama']; ?></td>
                                <td><?= $d['jabatan']; ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-warning text-white btn-sm px-3 shadow-sm" style="border-radius: 8px;">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="proses.php?aksi=hapus&id=<?= $d['id']; ?>" class="btn btn-danger btn-sm px-3 shadow-sm" style="border-radius: 8px;" onclick="return confirm('Hapus data guru ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
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