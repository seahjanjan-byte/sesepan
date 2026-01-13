<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDN Sesepan - Cerdas & Berkarakter</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .hero-section {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/img/school.jpg');
      background-size: cover;
      height: 80vh;
      display: flex;
      align-items: center;
      color: white;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">SDN SESEPAN</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profil
            </a>
            <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="profil_view.php?kat=tentang">Tentang Sekolah</a></li>
              <li><a class="dropdown-item" href="profil_view.php?kat=visi-misi">Visi & Misi</a></li>
              <li><a class="dropdown-item" href="profil_view.php?kat=struktur">Struktur Organisasi</a></li>
              <li><a class="dropdown-item" href="profil_view.php?kat=sejarah">Sejarah Sekolah</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="#">Guru</a></li>
          <li class="nav-item"><a class="nav-link" href="galeri.php">Fasilitas</a></li>
          <li class="nav-item"><a class="nav-link" href="galeri.php">PPDB</a></li>
          <li class="nav-item"><a class="nav-link" href="galeri.php">Prestasi</a></li>
          <li class="nav-item"><a class="nav-link" href="galeri.php">Galeri</a></li>
          <li class="nav-item"><a class="nav-link btn btn-warning text-dark ms-lg-2" href="#">Kontak</a></li>
        </ul>
      </div>
    </div>
  </nav>