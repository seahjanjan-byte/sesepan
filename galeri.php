<?php 
include 'config/config.php';
include 'includes/header.php'; 

// Fungsi Helper untuk mengubah link YouTube biasa menjadi link Embed
function get_youtube_embed($url) {
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    return $match[1] ?? '';
}
?>

<div class="container py-5 mt-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Galeri Kegiatan</h2>
        <p class="text-muted">Dokumentasi momen berharga di SDN Sesepan</p>
        <hr class="mx-auto" style="width: 100px; height: 3px; background-color: #3b82f6; opacity: 1;">
    </div>

    <div class="row g-4">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
        if(mysqli_num_rows($sql) == 0) {
            echo "<div class='col-12 text-center'><p class='text-muted'>Belum ada dokumentasi tersedia.</p></div>";
        }

        while($d = mysqli_fetch_array($sql)) {
        ?>
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                
                <?php if($d['kategori'] == 'video' && $d['tipe_sumber'] == 'link_youtube'): ?>
                    <div class="ratio ratio-16x9">
                        <?php $video_id = get_youtube_embed($d['sumber']); ?>
                        <iframe src="https://www.youtube.com/embed/<?= $video_id; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>

                <?php elseif($d['tipe_sumber'] == 'upload'): ?>
                    <img src="assets/img/<?= $d['sumber']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?= $d['judul']; ?>">

                <?php else: ?>
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <div class="text-center">
                            <i class="bi bi-folder-symlink fs-1 text-primary"></i>
                            <p class="mb-0 small fw-bold">Buka di Google Drive</p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge <?= $d['kategori'] == 'foto' ? 'bg-info' : 'bg-danger' ?> small">
                            <?= strtoupper($d['kategori']); ?>
                        </span>
                        <small class="text-muted"><?= date('d/m/Y', strtotime($d['tgl_upload'])); ?></small>
                    </div>
                    <h5 class="card-title fw-bold text-dark h6"><?= $d['judul']; ?></h5>
                    
                    <?php if($d['tipe_sumber'] == 'link_drive'): ?>
                        <a href="<?= $d['sumber']; ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100 mt-2 rounded-pill">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat di Drive
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>