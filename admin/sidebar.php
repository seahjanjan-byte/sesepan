<?php
// Tentukan base URL agar link tidak pecah (Sesuaikan sdn-sesepan dengan nama folder project kamu)
$base_url_admin = "/sdn-sesepan/admin/";
?>

<link rel="stylesheet" href="/sdn-sesepan/assets/css/style.css">

<div class="sidebar-indigo d-flex flex-column p-3 text-white">
    <h3 class="fw-bold mb-4 ps-2 text-center" style="letter-spacing: 2px;">SDN SESEPAN</h3>
    <hr class="text-white-50">
    
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>index.php" class="nav-link py-2">
                <i class="bi bi-speedometer2 me-3"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/berita/index.php" class="nav-link py-2">
                <i class="bi bi-newspaper me-3"></i> Kelola Berita
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/guru/index.php" class="nav-link py-2">
                <i class="bi bi-people me-3"></i> Data Guru
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/prestasi/index.php" class="nav-link py-2">
                <i class="bi bi-trophy me-3"></i> Prestasi
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/galeri/index.php" class="nav-link py-2">
                <i class="bi bi-images me-3"></i> Galeri Foto
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/fasilitas/index.php" class="nav-link py-2">
                <i class="bi bi-building me-3"></i> Kelola Fasilitas
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/ppdb/index.php" class="nav-link py-2">
                <i class="bi bi-mortarboard me-3"></i> Update PPDB
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/profil/index.php" class="nav-link py-2">
                <i class="bi bi-info-circle me-3"></i> Profil Sekolah
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/slider/index.php" class="nav-link py-2">
                <i class="bi bi-sliders me-3"></i> Kelola Slider
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="<?= $base_url_admin; ?>modul/pesan/index.php" class="nav-link py-2">
                <i class="bi bi-envelope me-3"></i> Pesan Masuk
            </a>
        </li>
    </ul>

    <div class="mt-auto ps-2 pb-4 border-top pt-3">
        <a href="<?= $base_url_admin; ?>logout.php" class="text-white text-decoration-none fw-bold opacity-75">
            <i class="bi bi-box-arrow-left me-2"></i> Keluar
        </a>
    </div>
</div>