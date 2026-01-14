<?php 
include 'config/config.php';
include 'includes/header.php'; 

// Ambil kategori dari URL jika ada
$cat = isset($_GET['cat']) ? $_GET['cat'] : 'semua';
?>

<div class="container py-5 mt-5 pt-lg-5">
    <div class="text-center mb-5 mt-4" data-aos="fade-up">
        <h2 class="fw-bold">Prestasi Sekolah</h2>
        <p class="text-muted">Kebanggaan dan pencapaian siswa-siswi SDN Sesepan</p>
        <hr class="mx-auto" style="width: 80px; height: 4px; background-color: #3b82f6; opacity: 1;">
    </div>

    <div class="d-flex justify-content-center gap-2 mb-5" data-aos="fade-up">
        <a href="<?= $base_url; ?>prestasi.php?cat=semua" class="btn <?= ($cat == 'semua') ? 'btn-primary' : 'btn-outline-primary'; ?> rounded-pill px-4">Semua</a>
        <a href="<?= $base_url; ?>prestasi.php?cat=akademik" class="btn <?= ($cat == 'akademik') ? 'btn-primary' : 'btn-outline-primary'; ?> rounded-pill px-4">Akademik</a>
        <a href="<?= $base_url; ?>prestasi.php?cat=non-akademik" class="btn <?= ($cat == 'non-akademik') ? 'btn-primary' : 'btn-outline-primary'; ?> rounded-pill px-4">Non-Akademik</a>
    </div>

    <div class="row g-4">
        <?php
        $query = "SELECT * FROM prestasi";
        if($cat != 'semua') {
            $query .= " WHERE kategori = '$cat'";
        }
        $query .= " ORDER BY tgl_prestasi DESC";
        
        $sql = mysqli_query($conn, $query);
        if(mysqli_num_rows($sql) > 0):
            while($d = mysqli_fetch_array($sql)): 
        ?>
            <div class="col-md-4" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-sesepan">
                    <div class="position-relative">
                        <img src="<?= $base_url; ?>assets/img/<?= $d['gambar']; ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm">
                            <?= strtoupper($d['kategori']); ?>
                        </span>
                    </div>
                    <div class="card-body p-4">
                        <small class="text-muted d-block mb-2"><i class="bi bi-calendar3 me-1"></i> <?= date('d/m/Y', strtotime($d['tgl_prestasi'])); ?></small>
                        <h5 class="fw-bold text-dark mb-3"><?= $d['judul_prestasi']; ?></h5>
                        <p class="text-secondary small mb-0" style="line-height: 1.6;"><?= nl2br($d['keterangan']); ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; else: ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-trophy display-1 text-light"></i>
                <p class="text-muted mt-3">Belum ada data prestasi untuk kategori ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>