<?php include 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SDN Sesepan - Cerdas & Berkarakter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-transparent" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="#">SDN SESEPAN</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item" href="profil_view.php?kat=tentang">Tentang Sekolah</a></li>
                        <li><a class="dropdown-item" href="profil_view.php?kat=visi-misi">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="profil_view.php?kat=struktur">Struktur</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Guru</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Fasilitas</a></li>
                <li class="nav-item"><a class="nav-link fw-bold text-primary" href="#">PPDB</a></li>
            </ul>
        </div>
    </div>
</nav>

<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false" data-bs-interval="2000">
    <div class="carousel-inner">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM slider");
        $active = "active";
        while($s = mysqli_fetch_array($sql)):
        ?>
        <div class="carousel-item <?= $active; ?>" style="height: 100vh; background: url('assets/img/<?= $s['gambar']; ?>') center/cover no-repeat;">
            <div class="hero-overlay text-white">
                <div class="container">
                    <div class="col-lg-7">
                        <h1 class="display-2 fw-bold mb-3"><?= $s['judul']; ?></h1>
                        <p class="fs-4 opacity-85"><?= $s['subjudul']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php $active = ""; endwhile; ?>
    </div>
</div>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center g-5 align-items-start">
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-megaphone-fill me-2"></i> Pengumuman</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item p-4 border-bottom">
                                <span class="badge bg-primary-subtle text-primary mb-2">10 Jan 2026</span>
                                <h6 class="fw-bold mb-0">Jadwal Pengambilan Rapor Semester Ganjil</h6>
                            </div>
                            <div class="list-group-item p-4 border-bottom">
                                <span class="badge bg-primary-subtle text-primary mb-2">05 Jan 2026</span>
                                <h6 class="fw-bold mb-0">PPDB Tahun Ajaran 2026/2027 Telah Dibuka</h6>
                            </div>
                        </div>
                        <div class="p-3 text-center bg-light">
                            <a href="#" class="text-decoration-none fw-bold small">LIHAT SEMUA PENGUMUMAN</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="ps-lg-4">
                    <?php 
                    $query_sk = mysqli_query($conn, "SELECT * FROM profil WHERE kategori='sambutan' LIMIT 1");
                    $sk = mysqli_fetch_array($query_sk); 
                    ?>
                    <h3 class="fw-bold text-primary mb-4">Sambutan Kepala Sekolah</h3>
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="rounded-4 overflow-hidden shadow-sm border">
                                <?php $foto = !empty($sk['gambar']) ? "assets/img/".$sk['gambar'] : "assets/img/default.jpg"; ?>
                                <img src="<?= $foto; ?>" class="img-fluid w-100" style="object-fit: cover; aspect-ratio: 3/4;">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <p class="text-muted fw-medium mb-2">Bismillahirrohmanirrohim...</p>
                            <div class="text-secondary" style="line-height: 1.8; text-align: justify; font-size: 0.95rem;">
                                <?= nl2br(substr($sk['isi'] ?? 'Teks sambutan sedang diperbarui.', 0, 500)); ?>...
                            </div>
                            <a href="profil_view.php?kat=sambutan" class="btn btn-outline-primary rounded-pill px-4 mt-4 fw-bold shadow-sm">
                                Baca Selengkapnya <i class="bi bi-arrow-right-short ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
            nav.classList.remove('navbar-transparent');
        } else {
            nav.classList.remove('scrolled');
            nav.classList.add('navbar-transparent');
        }
    });
</script>
</body>
</html>