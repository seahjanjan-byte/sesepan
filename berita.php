<?php 
include 'config/config.php';
include 'includes/header.php'; 
?>
<div class="container py-5 mt-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold">Berita & Kegiatan</h2>
        <hr class="mx-auto" style="width: 80px; height: 4px; background-color: #3b82f6; opacity: 1;">
    </div>
    <div class="row g-4">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM berita WHERE status='tampil' ORDER BY id DESC");
        while($b = mysqli_fetch_array($sql)): ?>
            <div class="col-md-4" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="assets/img/<?= $b['gambar']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold"><?= $b['judul']; ?></h5>
                        <p class="text-muted small"><?= substr(strip_tags($b['isi']), 0, 100); ?>...</p>
                        <a href="berita_view.php?id=<?= $b['id']; ?>" class="btn btn-link p-0 text-decoration-none fw-bold">Selengkapnya</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>