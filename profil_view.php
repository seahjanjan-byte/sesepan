<?php 
include 'config/config.php';
include 'includes/header.php'; 

// Mengambil kategori dari URL (kat=tentang, kat=visi-misi, dll)
$kat = $_GET['kat'];
$query = mysqli_query($conn, "SELECT * FROM profil WHERE kategori = '$kat'");
$d = mysqli_fetch_array($query);

if(!$d) { echo "<script>window.location='index.php';</script>"; exit; }
?>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark"><?= $d['judul']; ?></h2>
                <hr class="mx-auto" style="width: 80px; height: 4px; background-color: #3b82f6; border-radius: 2px; opacity: 1;">
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <?php if($d['gambar']): ?>
                    <div class="text-center mb-5">
                        <img src="assets/img/<?= $d['gambar']; ?>" class="img-fluid rounded shadow-sm border" alt="<?= $d['judul']; ?>">
                    </div>
                <?php endif; ?>

                <div class="content-text lead" style="line-height: 1.8; color: #4b5563;">
                    <?= nl2br($d['isi']); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>