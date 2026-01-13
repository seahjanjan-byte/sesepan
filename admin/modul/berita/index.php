<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Berita - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; margin: 0; }
        .content-main { margin-left: 250px; width: calc(100% - 250px); min-height: 100vh; }
        .custom-card { background-color: #fdfdfb; border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
<div class="d-flex">
    <?php include '../../sidebar.php'; ?> <div class="content-main">
        <div class="p-4 bg-white border-bottom">
            <h4 class="fw-bold mb-0">Kelola Berita</h4>
        </div>
        <div class="p-4">
            <div class="card custom-card p-4 text-dark">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="fw-bold">Daftar Berita</h5>
                    <a href="tambah.php" class="btn btn-primary btn-sm rounded-pill px-3">Tambah Berita</a>
                </div>
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr><th>No</th><th>Judul</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
                        while($d = mysqli_fetch_assoc($sql)){ ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="fw-semibold"><?= $d['judul']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="proses.php?aksi=hapus&id=<?= $d['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>