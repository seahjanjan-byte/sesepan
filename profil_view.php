<?php 
include 'config/config.php';
include 'includes/header.php'; 

// Amankan input kategori
$kat = isset($_GET['kat']) ? mysqli_real_escape_string($conn, $_GET['kat']) : '';

if($kat == 'visi-misi'){
    // Ambil data Visi
    $qv = mysqli_query($conn, "SELECT * FROM profil WHERE kategori = 'visi'");
    $dv = mysqli_fetch_array($qv);
    // Ambil data Misi
    $qm = mysqli_query($conn, "SELECT * FROM profil WHERE kategori = 'misi'");
    $dm = mysqli_fetch_array($qm);
    
    $judul = "Visi dan Misi Sekolah";
} else {
    $query = mysqli_query($conn, "SELECT * FROM profil WHERE kategori = '$kat'");
    $d = mysqli_fetch_array($query);
    
    // Jika data tidak ditemukan, kembalikan ke beranda menggunakan base_url
    if(!$d) { echo "<script>window.location='" . $base_url . "index.php';</script>"; exit; }
    $judul = $d['judul'];
}
?>

<div class="container py-5 mt-5 pt-lg-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center mb-5" data-aos="fade-down">
                <h2 class="fw-bold text-dark text-uppercase"><?= $judul; ?></h2>
                <hr class="mx-auto" style="width: 80px; height: 4px; background-color: #3b82f6; border-radius: 2px; opacity: 1;">
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white" data-aos="fade-up">
                <?php if($kat == 'visi-misi'): ?>
                    <div class="mb-5">
                        <h4 class="fw-bold text-primary mb-4"><i class="bi bi-eye-fill me-2"></i> VISI</h4>
                        <div class="ps-3 border-start border-primary border-4">
                            <ul class="fs-5 list-unstyled">
                                <?php 
                                $visis = explode("[BREAK]", $dv['isi'] ?? '');
                                foreach($visis as $v) { 
                                    if(!empty(trim($v))) echo "<li class='mb-2'><i class='bi bi-check2-circle text-primary me-2'></i> $v</li>"; 
                                } 
                                ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="fw-bold text-primary mb-4"><i class="bi bi-rocket-takeoff-fill me-2"></i> MISI</h4>
                        <div class="ps-3 border-start border-primary border-4">
                            <ol class="fs-5 lh-lg">
                                <?php 
                                $misis = explode("[BREAK]", $dm['isi'] ?? '');
                                foreach($misis as $m) { 
                                    if(!empty(trim($m))) echo "<li class='mb-3'>$m</li>"; 
                                } 
                                ?>
                            </ol>
                        </div>
                    </div>

                <?php else: ?>
                    <?php if(!empty($d['gambar'])): ?>
                        <div class="text-center mb-5">
                            <img src="<?= $base_url; ?>assets/img/<?= $d['gambar']; ?>" class="img-fluid rounded-4 shadow-sm border border-5 border-white">
                        </div>
                    <?php endif; ?>
                    
                    <div class="content-text" style="line-height: 1.9; color: #374151; font-size: 1.1rem; text-align: justify;">
                        <?= nl2br($d['isi']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="text-center mt-5">
                <a href="<?= $base_url; ?>index.php" class="btn btn-outline-primary px-5 rounded-pill fw-bold">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>