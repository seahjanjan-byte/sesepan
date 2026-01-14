<footer class="bg-dark text-white pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h4 class="fw-bold mb-4">SDN SESEPAN</h4>
                <p class="opacity-75" style="line-height: 1.8;">
                    Mewujudkan generasi yang cerdas, religius, dan berkarakter unggul melalui lingkungan pendidikan yang aman, nyaman, dan berkualitas.
                </p>
                <div class="mt-3">
                    <a href="#" class="text-white me-3 fs-5 opacity-75 hover-opacity-100"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3 fs-5 opacity-75 hover-opacity-100"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white me-3 fs-5 opacity-75 hover-opacity-100"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-4 mb-4 ps-lg-5">
                <h5 class="fw-bold mb-4">Navigasi</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?= $base_url; ?>guru.php" class="text-white text-decoration-none opacity-75">Daftar Guru</a></li>
                    <li class="mb-2"><a href="<?= $base_url; ?>fasilitas.php" class="text-white text-decoration-none opacity-75">Fasilitas Sekolah</a></li>
                    <li class="mb-2"><a href="<?= $base_url; ?>pengumuman.php" class="text-white text-decoration-none opacity-75">Daftar Pengumuman</a></li>
                    <li class="mb-2"><a href="<?= $base_url; ?>ppdb.php" class="text-white text-decoration-none opacity-75">Info Pendaftaran</a></li>
                </ul>
            </div>

            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-4">Informasi Sekolah</h5>
                <p class="opacity-75 mb-2"><i class="bi bi-geo-alt-fill me-2 text-primary"></i> Jl. Sesepan, Kec. Balapulang, Tegal.</p>
                <p class="opacity-75 mb-2"><i class="bi bi-telephone-fill me-2 text-primary"></i> (0283) 123456</p>
                <p class="opacity-75 mb-2"><i class="bi bi-envelope-fill me-2 text-primary"></i> info@sdnsesepan.sch.id</p>
            </div>
        </div>
        
        <hr class="opacity-25 my-4">
        
        <div class="text-center">
            <p class="small mb-0 opacity-50">&copy; <?= date('Y'); ?> SDN Sesepan. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  // Inisialisasi AOS (Animation On Scroll)
  AOS.init({
    duration: 1000,
    once: true,
    offset: 120
  });

  // Script Navbar Global (Tetap ada di footer agar terpanggil di semua halaman)
  const handleNavbar = () => {
      const nav = document.querySelector('#mainNav');
      if (!nav) return;
      const isHome = <?= json_encode($is_home); ?>;
      
      if(isHome) {
          const isScrolled = window.scrollY > 50;
          nav.classList.toggle('scrolled', isScrolled);
          nav.classList.toggle('navbar-transparent', !isScrolled);
      } else {
          nav.classList.add('scrolled');
          nav.classList.remove('navbar-transparent');
      }
  };

  window.addEventListener('scroll', handleNavbar, { passive: true });
  document.addEventListener('DOMContentLoaded', handleNavbar);
</script>
</body>
</html>