<?php 
include 'config/config.php';
include 'includes/header.php'; 

// Ambil ID berita dari URL dan amankan
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

// Ambil data berita
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id = '$id' AND status = 'tampil'");
$b = mysqli_fetch_array($query);

// Jika berita tidak ditemukan, kembalikan ke beranda menggunakan base_url
if (!$b) { echo "<script>window.location='" . $base_url . "index.php';</script>"; exit; }
?>

<div class="container py-5 mt-5 pt-lg-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <nav aria-label="breadcrumb" class="mb-4 bg-light p-3 rounded-3 shadow-sm border-start border-primary border-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= $base_url; ?>index.php" class="text-decoration-none"><i class="bi bi-house-door-fill"></i> Beranda</a></li>
                    <li class="breadcrumb-item"><a href="<?= $base_url; ?>berita.php" class="text-decoration-none">Berita</a></li>
                    <li class="breadcrumb-item active text-truncate" aria-current="page"><?= $b['judul']; ?></li>
                </ol>
            </nav>

            <h1 class="display-5 fw-bold text-dark mb-3" style="line-height: 1.2;"><?= $b['judul']; ?></h1>
            
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 py-3 border-top border-bottom">
                <div class="d-flex align-items-center gap-4 text-muted small">
                    <span><i class="bi bi-person-circle text-primary me-2"></i> ADMINISTRATOR</span>
                    <span><i class="bi bi-calendar3 text-primary me-2"></i> <?= date('d F Y', strtotime($b['tanggal'] ?? date('Y-m-d'))); ?></span>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary rounded-circle"><i class="bi bi-facebook"></i></button>
                    <button class="btn btn-sm btn-outline-info rounded-circle"><i class="bi bi-twitter-x"></i></button>
                    <button class="btn btn-sm btn-outline-success rounded-circle"><i class="bi bi-whatsapp"></i></button>
                </div>
            </div>

            <?php if ($b['gambar']): ?>
            <div class="position-relative mb-5">
                <div class="rounded-4 overflow-hidden shadow-lg border">
                    <img src="<?= $base_url; ?>assets/img/<?= $b['gambar']; ?>" class="img-fluid w-100" style="max-height: 550px; object-fit: cover;" alt="<?= $b['judul']; ?>">
                </div>
            </div>
            <?php endif; ?>

            <div class="news-content text-justify" style="font-size: 1.15rem; line-height: 2; color: #334155;">
                <?= nl2br($b['isi']); ?>
            </div>

            <div class="mt-5 pt-4 border-top">
                <a href="<?= $base_url; ?>berita.php" class="btn btn-primary px-4 rounded-pill fw-bold shadow-sm transition-all">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Berita
                </a>
            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>