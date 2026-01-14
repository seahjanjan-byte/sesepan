<?php 
include 'config/config.php';
include 'includes/header.php'; 
?>
<div class="container py-5 mt-5 pt-lg-5">
    <div class="text-center mb-5 mt-4" data-aos="fade-up">
        <h2 class="fw-bold">Tenaga Pengajar</h2>
        <hr class="mx-auto" style="width: 80px; height: 4px; background-color: #3b82f6; opacity: 1;">
    </div>
    
    <div class="row g-4">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM guru ORDER BY id ASC");
        while($g = mysqli_fetch_array($sql)): ?>
            <div class="col-md-3 text-center" data-aos="zoom-in">
                <div class="p-4 bg-white shadow-sm rounded-4 border-top border-primary border-4">
                    <img src="assets/img/<?= $g['foto']; ?>" class="rounded-circle mb-3 border" style="width: 120px; height: 120px; object-fit: cover;">
                    <h6 class="fw-bold mb-1"><?= $g['nama']; ?></h6>
                    <span class="badge bg-light text-primary rounded-pill"><?= $g['jabatan']; ?></span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>