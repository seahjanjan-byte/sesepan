<?php include '../../../config/config.php'; 
include '../../cek_session.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pengaturan Profil Sekolah - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>
    <div class="content-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Pengaturan Profil Sekolah</h3>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-info-circle me-2"></i> Daftar Kategori Profil</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3" width="10%">No</th>
                            <th class="py-3">Kategori Profil</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Daftar kategori manual sesuai keinginan Anda
                        $menus = [
                            ['no' => 1, 'nama' => 'Tentang Sekolah', 'kat' => 'tentang', 'folder' => 'tentang'],
                            ['no' => 2, 'nama' => 'Visi dan Misi', 'kat' => 'visi', 'folder' => 'visi-misi'],
                            ['no' => 3, 'nama' => 'Struktur Organisasi', 'kat' => 'struktur', 'folder' => 'struktur'],
                            ['no' => 4, 'nama' => 'Sejarah Sekolah', 'kat' => 'sejarah', 'folder' => 'sejarah']
                        ];

                        foreach($menus as $m):
                            // Cek apakah data sudah ada di tabel profil
                            $kategori = $m['kat'];
                            $cek = mysqli_query($conn, "SELECT id_profil FROM profil WHERE kategori='$kategori'");
                            $ada = mysqli_num_rows($cek) > 0;
                        ?>
                        <tr>
                            <td class="px-4 fw-bold"><?= $m['no']; ?></td>
                            <td class="fw-semibold"><?= $m['nama']; ?></td>
                            <td>
                                <?= $ada ? '<span class="badge bg-success">Tersedia</span>' : '<span class="badge bg-danger">Belum Diisi</span>'; ?>
                            </td>
                            <td class="text-center">
                                <?php if($ada): ?>
                                    <a href="../<?= $m['folder']; ?>/index.php" class="btn btn-primary btn-sm px-4 rounded-pill">Kelola</a>
                                <?php else: ?>
                                    <a href="tambah.php?kat=<?= $kategori; ?>" class="btn btn-warning btn-sm px-4 rounded-pill">Input Data</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>