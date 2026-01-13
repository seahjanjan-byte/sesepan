<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Berita - Admin SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>

    <div class="content-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark m-0">Pengelolaan Berita</h3>
            <a href="tambah.php" class="btn-primary-sesepan text-decoration-none">
                <i class="bi bi-plus-lg me-2"></i> Tambah Berita
            </a>
        </div>

        <div class="card-sesepan">
            <div class="card-header-blue text-white">
                <h5 class="mb-0 fw-bold"><i class="bi bi-newspaper me-2"></i> Daftar Berita</h5>
            </div>
            <div class="card-sesepan-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3" width="5%">No</th>
                                <th class="py-3">Gambar</th>
                                <th class="py-3">Judul Berita</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
                            while($d = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td class="px-4 fw-bold"><?= $no++; ?></td>
                                <td>
                                    <?php if($d['gambar'] != ""): ?>
                                        <img src="../../../assets/img/<?= $d['gambar']; ?>" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                    <?php endif; ?>
                                </td>
                                <td class="fw-semibold"><?= $d['judul']; ?></td>
                                <td>
                                    <?php if($d['status'] == 'tampil'): ?>
                                        <span class="badge bg-success">Ditampilkan</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Diarsipkan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <?php if($d['status'] == 'tampil'): ?>
                                            <a href="proses.php?aksi=status&id=<?= $d['id']; ?>&set=arsip" class="btn btn-sm btn-dark px-3" title="Arsipkan">
                                                <i class="bi bi-eye-slash"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="proses.php?aksi=status&id=<?= $d['id']; ?>&set=tampil" class="btn btn-sm btn-info text-white px-3" title="Tampilkan">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        <?php endif; ?>

                                        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-warning px-3"><i class="bi bi-pencil-square"></i></a>
                                        <a href="proses.php?aksi=hapus&id=<?= $d['id']; ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Hapus berita ini?')"><i class="bi bi-trash"></i></a>
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