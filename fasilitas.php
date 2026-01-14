<?php 
include 'config/config.php';
include 'includes/header.php'; 
?>

<div class="container py-5 mt-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold text-dark">Fasilitas Sekolah</h2>
        <p class="text-muted">Sarana dan prasarana pendukung kegiatan belajar mengajar di SDN Sesepan</p>
        <hr class="mx-auto" style="width: 80px; height: 4px; background-color: #3b82f6; border-radius: 2px; opacity: 1;">
    </div>

    <div class="row g-4">
        <?php
        // Mengambil data dari tabel fasilitas
        $sql = mysqli_query($conn, "SELECT * FROM fasilitas ORDER BY id DESC");
        
        if(mysqli_num_rows($sql) > 0):
            $delay = 100; // Inisialisasi delay animasi
            while($f = mysqli_fetch_array($sql)):
        ?>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-all">
                    <div class="position-relative">
                        <?php 
                        $gambar = (!empty($f['gambar']) && file_exists("assets/img/" . $f['gambar'])) 
                                  ? "assets/img/" . $f['gambar'] 
                                  : "assets/img/default-fasilitas.jpg"; 
                        ?>
                        <img src="<?= $gambar; ?>" class="card-img-top" style="height: 240px; object-fit: cover;" alt="<?= $f['nama_fasilitas']; ?>">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                <h5 class="text-white fw-bold mb-0"><?= $f['nama_fasilitas']; ?></h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <p class="text-secondary small mb-0" style="line-height: 1.6; text-align: justify;">
                            <?= nl2br($f['deskripsi']); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php 
            $delay += 100; // Tambah delay agar muncul bergantian
            endwhile; 
        else:
        ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-building display-1 text-light"></i>
                <p class="text-muted mt-3">Data fasilitas belum tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>