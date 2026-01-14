<?php 
include 'config/config.php'; 
include 'includes/header.php'; 
?>

<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false" data-bs-interval="2000">
    <div class="carousel-inner">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM slider");
        $active = "active";
        while ($s = mysqli_fetch_array($sql)):
        ?>
            <div class="carousel-item <?= $active; ?>" style="height: 100vh; background: url('assets/img/<?= $s['gambar']; ?>') center/cover no-repeat;">
                <div class="hero-overlay text-white">
                    <div class="container">
                        <div class="col-lg-7" data-aos="fade-right"> <h1 class="display-2 fw-bold mb-3"><?= $s['judul']; ?></h1>
                            <p class="fs-4 opacity-85"><?= $s['subjudul']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php $active = ""; endwhile; ?>
    </div>
</div>

<section class="py-5 bg-white overflow-hidden">
    <div class="container">
        <div class="row justify-content-center g-5 align-items-start">
            
            <div class="col-lg-4" data-aos="fade-right" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-megaphone-fill me-2"></i> Pengumuman</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <?php
                            $q_peng = mysqli_query($conn, "SELECT * FROM pengumuman WHERE status='aktif' ORDER BY tanggal DESC LIMIT 3");
                            if (mysqli_num_rows($q_peng) > 0):
                                while ($p = mysqli_fetch_array($q_peng)):
                            ?>
                                <div class="list-group-item p-4 border-bottom transition-all">
                                    <span class="badge bg-primary-subtle text-primary mb-2"><?= date('d M Y', strtotime($p['tanggal'])); ?></span>
                                    <h6 class="fw-bold mb-2 text-dark"><?= $p['judul']; ?></h6>
                                    <?php if (!empty($p['dokumen'])): ?>
                                        <a href="assets/doc/<?= $p['dokumen']; ?>" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 mt-2">
                                            <i class="bi bi-file-earmark-pdf me-1"></i> Lihat Lampiran
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; else: ?>
                                <div class='p-4 text-center text-muted'>Belum ada pengumuman aktif.</div>
                            <?php endif; ?>
                        </div>
                        <div class="p-3 text-center bg-light">
                            <a href="pengumuman.php" class="text-decoration-none fw-bold small text-primary">LIHAT SEMUA PENGUMUMAN</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="400">
                <div class="ps-lg-4">
                    <?php
                    $query_sk = mysqli_query($conn, "SELECT * FROM profil WHERE kategori='sambutan' LIMIT 1");
                    $sk = mysqli_fetch_array($query_sk);
                    ?>
                    <h3 class="fw-bold text-primary mb-4">Sambutan Kepala Sekolah</h3>
                    <div class="row g-4">
                        <div class="col-md-5" data-aos="zoom-in" data-aos-delay="600">
                            <div class="rounded-4 overflow-hidden shadow-sm border bg-light">
                                <?php $foto = (!empty($sk['gambar']) && file_exists("assets/img/" . $sk['gambar'])) ? "assets/img/" . $sk['gambar'] : "assets/img/default.jpg"; ?>
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

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-dark">Berita & Kegiatan Terbaru</h2>
            <hr class="mx-auto" style="width: 80px; height: 4px; background-color: #3b82f6; border-radius: 2px; opacity: 1;">
        </div>
        <div class="row g-4">
            <?php
            $delay = 200; // Inisialisasi delay awal
            $sql_news = mysqli_query($conn, "SELECT * FROM berita WHERE status='tampil' ORDER BY id DESC LIMIT 3");
            while ($bn = mysqli_fetch_array($sql_news)):
            ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <img src="assets/img/<?= $bn['gambar']; ?>" class="card-img-top" style="height: 220px; object-fit: cover;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3"><?= $bn['judul']; ?></h5>
                            <p class="text-muted small mb-4"><?= substr(strip_tags($bn['isi']), 0, 100); ?>...</p>
                            <a href="berita_view.php?id=<?= $bn['id']; ?>" class="btn btn-link text-primary fw-bold p-0 text-decoration-none">
                                Selengkapnya <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php $delay += 200; endwhile; ?> </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<script>
    function handleNavbar() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
            nav.classList.remove('navbar-transparent');
        } else {
            // Jika di posisi paling atas (scrollY < 50)
            nav.classList.remove('scrolled');
            nav.classList.add('navbar-transparent');
        }
    }

    // Jalankan saat scroll
    window.addEventListener('scroll', handleNavbar);

    // Jalankan saat halaman baru selesai dimuat (antisipasi jika user refresh di tengah halaman)
    window.addEventListener('load', handleNavbar);
</script>