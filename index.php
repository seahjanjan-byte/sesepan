<?php 
include 'config/config.php'; 
include 'includes/header.php'; 
// JANGAN sertakan cek_session.php di sini karena ini halaman publik
?>

<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false" data-bs-interval="3000">
    <div class="carousel-inner">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM slider");
        $active = "active";
        while ($s = mysqli_fetch_array($sql)):
        ?>
            <div class="carousel-item <?= $active; ?>" style="height: 100vh; background: url('<?= $base_url; ?>assets/img/<?= $s['gambar']; ?>') center/cover no-repeat;">
                <div class="hero-overlay text-white">
                    <div class="container">
                        <div class="col-lg-7" data-aos="fade-right">
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
            <div class="col-lg-4" data-aos="fade-right">
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
                                        <a href="<?= $base_url; ?>assets/doc/<?= $p['dokumen']; ?>" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 mt-2">
                                            <i class="bi bi-file-earmark-pdf me-1"></i> Lihat Lampiran
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; else: ?>
                                <div class='p-4 text-center text-muted'>Belum ada pengumuman aktif.</div>
                            <?php endif; ?>
                        </div>
                        <div class="p-3 text-center bg-light">
                            <a href="<?= $base_url; ?>pengumuman.php" class="text-decoration-none fw-bold small text-primary">LIHAT SEMUA PENGUMUMAN</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <div class="ps-lg-4">
                    <?php
                    $query_sk = mysqli_query($conn, "SELECT * FROM profil WHERE kategori='sambutan' LIMIT 1");
                    $sk = mysqli_fetch_array($query_sk);
                    ?>
                    <h3 class="fw-bold text-primary mb-4">Sambutan Kepala Sekolah</h3>
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="rounded-4 overflow-hidden shadow-sm border bg-light">
                                <?php
                                $foto_path = "assets/img/" . ($sk['gambar'] ?? '');
                                $foto = (!empty($sk['gambar']) && file_exists($foto_path)) ? $base_url . $foto_path : $base_url . "assets/img/logoo.png";
                                ?>
                                <img src="<?= $foto; ?>" class="img-fluid w-100" style="object-fit: cover; aspect-ratio: 3/4;">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <p class="text-muted fw-medium mb-2">Bismillahirrohmanirrohim...</p>
                            <div class="text-secondary" style="line-height: 1.8; text-align: justify; font-size: 0.95rem;">
                                <?= nl2br(substr($sk['isi'] ?? 'Teks sambutan sedang diperbarui.', 0, 500)); ?>...
                            </div>
                            <a href="<?= $base_url; ?>profil_view.php?kat=sambutan" class="btn btn-outline-primary rounded-pill px-4 mt-4 fw-bold shadow-sm">
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
            $sql_news = mysqli_query($conn, "SELECT * FROM berita WHERE status='tampil' ORDER BY id DESC LIMIT 3");
            while ($bn = mysqli_fetch_array($sql_news)):
            ?>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-sesepan">
                        <img src="<?= $base_url; ?>assets/img/<?= $bn['gambar']; ?>" class="card-img-top" style="height: 220px; object-fit: cover;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3"><?= $bn['judul']; ?></h5>
                            <p class="text-muted small mb-4"><?= substr(strip_tags($bn['isi']), 0, 100); ?>...</p>
                            <a href="<?= $base_url; ?>berita_view.php?id=<?= $bn['id']; ?>" class="btn btn-link text-primary fw-bold p-0 text-decoration-none">
                                Selengkapnya <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<section id="hubungi-kami" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-dark">Hubungi Kami</h2>
            <hr class="mx-auto" style="width: 80px; height: 4px; background-color: #3b82f6; border-radius: 2px; opacity: 1;">
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <h5 class="fw-bold mb-4">Kirim Pesan</h5>
                    <form action="<?= $base_url; ?>proses_kontak.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control bg-light border-0 py-2 px-3" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Alamat Email</label>
                            <input type="email" name="email" class="form-control bg-light border-0 py-2 px-3" placeholder="nama@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nomor Telepon/WA</label>
                            <input type="text" name="telepon" class="form-control bg-light border-0 py-2 px-3" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Subjek</label>
                            <input type="text" name="subjek" class="form-control bg-light border-0 py-2 px-3" placeholder="Tanya PPDB / Info Sekolah" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Pesan</label>
                            <textarea name="isi_pesan" class="form-control bg-light border-0 py-2 px-3" rows="4" placeholder="Tuliskan pesan Anda..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm">Kirim Pesan Sekarang</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-light">
                    <h5 class="fw-bold mb-4">Informasi Sekolah</h5>
                    <div class="d-flex mb-3">
                        <i class="bi bi-geo-alt-fill text-primary me-3 fs-5"></i>
                        <p class="small mb-0 text-secondary">Jl. Sesepan, Kec. Balapulang, Tegal, Jawa Tengah.</p>
                    </div>
                    <div class="rounded-3 overflow-hidden border mb-4" style="height: 250px;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15837.287513364402!2d109.11!3d-7.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDAnMDAuMCJTIDEwOcKwMDYnMDAuMCJF!5e0!3m2!1sid!2sid!4v123456789" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="mb-2">
                        <label class="fw-bold small d-block">Kontak:</label>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-telephone-fill text-primary me-2"></i>
                            <span class="small text-secondary">(0283) 123456</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope-fill text-primary me-2"></i>
                            <span class="small text-secondary">info@sdnsesepan.sch.id</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if(isset($_GET['status']) && $_GET['status'] == 'terkirim'): ?>
<script>
    Swal.fire({
        title: "Pesan Terkirim!",
        text: "Terima kasih, kami akan segera merespons pesan Anda.",
        icon: "success",
        timer: 3500,
        showConfirmButton: false,
        timerProgressBar: true,
        customClass: { popup: 'rounded-4 shadow-lg' }
    });
</script>
<?php endif; ?>