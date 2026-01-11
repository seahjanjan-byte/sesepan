<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Fasilitas Sekolah - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        /* Mengatur warna card agar mirip dengan gambar (Soft Grey/Beige) */
        .custom-card {
            background-color: #fdfdfb; 
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .btn-add { background-color: #2c3e50; color: white; border-radius: 20px; padding: 8px 20px; }
        .btn-add:hover { background-color: #34495e; color: white; }
        .table thead { border-bottom: 2px solid #eee; }
        .img-thumbnail-custom { width: 80px; height: 50px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include '../../sidebar.php'; ?>

    <div class="content-main">
        <div class="p-4 bg-white border-bottom">
            <h4 class="fw-bold mb-0">Fasilitas Sekolah</h4>
        </div>

        <div class="p-4">
            <div class="card custom-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Daftar Fasilitas</h5>
                    <a href="tambah.php" class="btn btn-add btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Fasilitas
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-muted">
                                <th width="5%">No</th>
                                <th width="15%">Gambar</th>
                                <th width="60%">Nama Fasilitas</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM fasilitas ORDER BY id DESC");
                            while($d = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td class="fw-bold"><?= $no++; ?></td>
                                <td>
                                    <img src="../../../assets/img/<?= $d['gambar']; ?>" class="img-thumbnail-custom">
                                </td>
                                <td class="text-capitalize fw-semibold"><?= $d['nama_fasilitas']; ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-warning text-white btn-sm px-3 shadow-sm" style="border-radius: 8px;">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="proses.php?aksi=hapus&id=<?= $d['id']; ?>" class="btn btn-danger btn-sm px-3 shadow-sm" style="border-radius: 8px;" onclick="return confirm('Hapus fasilitas ini?')">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>