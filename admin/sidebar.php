<?php
// Tentukan base URL agar link tidak pecah (Sesuaikan sdn-sesepan dengan nama folder project kamu)
$base_url_admin = "/sdn-sesepan/admin/";
?>

<div class="sidebar d-flex flex-column p-3 text-white" style="width: 250px; min-height: 100vh; position: fixed; background-color: #2c3e50; z-index: 1000;">
    <h3 class="fw-bold mb-4 ps-2" style="letter-spacing: 2px;">SDN SESEPAN</h3>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>index.php" class="nav-link text-white py-2">
                <i class="bi bi-speedometer2 me-3"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/berita/index.php" class="nav-link text-white py-2">
                <i class="bi bi-newspaper me-3"></i> Kelola Berita
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/guru/index.php" class="nav-link text-white py-2">
                <i class="bi bi-people me-3"></i> Data Guru
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/prestasi/index.php" class="nav-link text-white py-2">
                <i class="bi bi-trophy me-3"></i> Prestasi
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/galeri/index.php" class="nav-link text-white py-2">
                <i class="bi bi-images me-3"></i> Galeri Foto
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/fasilitas/index.php" class="nav-link text-white py-2">
                <i class="bi bi-building me-3"></i> Kelola Fasilitas
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/ppdb/index.php" class="nav-link text-white py-2">
                <i class="bi bi-mortarboard me-3"></i> Update PPDB
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/profil/index.php" class="nav-link text-white py-2">
                <i class="bi bi-info-circle me-3"></i> Profil Sekolah
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/slider/index.php" class="nav-link text-white py-2">
                <i class="bi bi-sliders me-3"></i> Kelola Slider
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/pesan/index.php" class="nav-link text-white py-2">
                <i class="bi bi-envelope me-3"></i> Pesan Masuk
            </a>
        </li>
    </ul>
    <div class="mt-auto ps-2 pb-4">
        <a href="<?= $base_url_admin; ?>logout.php" class="text-danger text-decoration-none fw-bold">
            <i class="bi bi-box-arrow-left me-2"></i> Keluar
        </a>
    </div>
</div>

<style>
    /* Agar menu aktif otomatis (opsional: butuh logika PHP tambahan untuk class active) */
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    /* Perbaikan agar konten tidak tertutup sidebar */
    .content-main {
        margin-left: 250px;
        width: calc(100% - 250px);
        background-color: #ffffff;
        min-height: 100vh;
    }

    body {
        background-color: #f4f7f6;
        margin: 0;
    }
</style>