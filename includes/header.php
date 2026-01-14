<?php 
  // 1. Tentukan dulu halamannya di bagian paling atas!
  $current_page = basename($_SERVER['PHP_SELF']);
  $is_home = ($current_page == 'index.php');
  $nav_class = $is_home ? 'navbar-transparent' : 'scrolled';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDN Sesepan - Cerdas & Berkarakter</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="<?= ($is_home) ? 'home-page' : ''; ?>">

  <nav class="navbar navbar-expand-lg fixed-top <?= $nav_class; ?>" id="mainNav">
    <div class="container">
      <a class="navbar-brand fw-bold fs-3 d-flex align-items-center" href="index.php">
        <img src="assets/img/logoo.png" alt="Logo" width="50" height="50" class="me-2">
        SDN SESEPAN
      </a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profil</a>
            <ul class="dropdown-menu border-0 shadow-lg mt-2">
              <li><a class="dropdown-item py-2" href="profil_view.php?kat=tentang">Tentang Sekolah</a></li>
              <li><a class="dropdown-item py-2" href="profil_view.php?kat=visi-misi">Visi & Misi</a></li>
              <li><a class="dropdown-item py-2" href="profil_view.php?kat=struktur">Struktur Organisasi</a></li>
              <li><a class="dropdown-item py-2" href="profil_view.php?kat=sejarah">Sejarah Sekolah</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="guru.php">Guru</a></li>
          <li class="nav-item"><a class="nav-link" href="berita.php">Berita</a></li>
          <li class="nav-item"><a class="nav-link" href="fasilitas.php">Fasilitas</a></li>
          <li class="nav-item"><a class="nav-link" href="pengumuman.php">Pengumuman</a></li>
          <li class="nav-item"><a class="nav-link" href="galeri.php">Galeri</a></li>
          <li class="nav-item">
            <a class="nav-link fw-bold text-primary" href="ppdb.php">PPDB</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php if($is_home): ?>
  <script>
    // Script pendeteksi scroll
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
  <?php endif; ?>