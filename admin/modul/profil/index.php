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
                            <th class="py-3 text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 fw-bold">1</td>
                            <td class="fw-semibold">Tentang Sekolah</td>
                            <td class="text-center">
                                <a href="../tentang/index.php" class="btn btn-primary btn-sm px-4 rounded-pill">Kelola</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 fw-bold">2</td>
                            <td class="fw-semibold">Visi dan Misi</td>
                            <td class="text-center">
                                <a href="../visi-misi/index.php" class="btn btn-primary btn-sm px-4 rounded-pill">Kelola</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 fw-bold">3</td>
                            <td class="fw-semibold">Struktur Organisasi</td>
                            <td class="text-center">
                                <a href="../struktur/index.php" class="btn btn-primary btn-sm px-4 rounded-pill">Kelola</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 fw-bold">4</td>
                            <td class="fw-semibold">Sejarah Sekolah</td>
                            <td class="text-center">
                                <a href="../sejarah/index.php" class="btn btn-primary btn-sm px-4 rounded-pill">Kelola</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>