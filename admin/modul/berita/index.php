<?php 
// Naik 3 kali: keluar dari berita, keluar dari modul, keluar dari admin
include '../../../config/config.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Berita - SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h3>Modul Berita</h3>
            <a href="tambah.php" class="btn btn-primary btn-sm">Tambah Berita</a>
        </div>
        
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
                while($d = mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['judul']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="proses.php?aksi=hapus&id=<?= $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="../../index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</body>
</html>