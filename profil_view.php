<?php 
include 'config/config.php';
include 'includes/header.php'; 

$kat = $_GET['kat'];

if($kat == 'visi-misi'){
    // Ambil data Visi
    $qv = mysqli_query($conn, "SELECT * FROM profil WHERE kategori = 'visi'");
    $dv = mysqli_fetch_array($qv);
    // Ambil data Misi
    $qm = mysqli_query($conn, "SELECT * FROM profil WHERE kategori = 'misi'");
    $dm = mysqli_fetch_array($qm);
    
    $judul = "Visi dan Misi";
} else {
    $query = mysqli_query($conn, "SELECT * FROM profil WHERE kategori = '$kat'");
    $d = mysqli_fetch_array($query);
    if(!$d) { echo "<script>window.location='index.php';</script>"; exit; }
    $judul = $d['judul'];
}
?>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center mb-5" data-aos="fade-down">
                <h2 class="fw-bold text-dark"><?= $judul; ?></h2>
                <hr class="mx-auto" style="width: 80px; height: 4px; background-color: #3b82f6; border-radius: 2px; opacity: 1;">
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white" data-aos="fade-up">
                <?php if($kat == 'visi-misi'): ?>
                    <h4 class="fw-bold text-primary mb-3">VISI</h4>
                    <ul class="mb-5 fs-5">
                        <?php 
                        $visis = explode("[BREAK]", $dv['isi']);
                        foreach($visis as $v) { if(!empty($v)) echo "<li>$v</li>"; }
                        ?>
                    </ul>
                    <h4 class="fw-bold text-primary mb-3">MISI</h4>
                    <ol class="fs-5">
                        <?php 
                        $misis = explode("[BREAK]", $dm['isi']);
                        foreach($misis as $m) { if(!empty($m)) echo "<li>$m</li>"; }
                        ?>
                    </ol>
                <?php else: ?>
                    <?php if(!empty($d['gambar'])): ?>
                        <div class="text-center mb-5">
                            <img src="assets/img/<?= $d['gambar']; ?>" class="img-fluid rounded shadow-sm border">
                        </div>
                    <?php endif; ?>
                    <div class="content-text lead" style="line-height: 1.8; color: #4b5563;">
                        <?= nl2br($d['isi']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>