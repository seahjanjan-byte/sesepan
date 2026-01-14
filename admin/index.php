<?php 
include '../config/config.php'; 

// 1. Logika untuk menentukan waktu salam
$jam = date('H');
if ($jam >= 5 && $jam < 11) {
    $salam = "Pagi";
} elseif ($jam >= 11 && $jam < 15) {
    $salam = "Siang";
} elseif ($jam >= 15 && $jam < 19) {
    $salam = "Sore";
} else {
    $salam = "Malam";
}

// 2. Query untuk menghitung jumlah pesan masuk (yang belum diarsip)
$query_pesan = mysqli_query($conn, "SELECT id FROM pesan WHERE status != 'arsip'");
$total_pesan = mysqli_num_rows($query_pesan);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">

<div class="main-wrapper">
    <?php include 'sidebar.php'; ?>

    <div class="content-main">
        <div class="bg-white p-4 rounded-4 shadow-sm mb-4 border-start border-primary border-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold text-dark m-0">Selamat <?= $salam; ?>, Admin!</h2>
                    <p class="text-muted m-0">Panel kendali konten website resmi SDN Sesepan.</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="../index.php" target="_blank" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-globe me-2"></i> Lihat Website
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row mt-2">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-warning text-dark h-100 position-relative overflow-hidden">
                    <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
                        <div>
                            <p class="mb-1 fw-bold opacity-75">Pesan Masuk</p>
                            <h2 class="fw-bold mb-0 display-4"><?= $total_pesan; ?></h2>
                        </div>
                        <i class="bi bi-envelope-paper display-3 opacity-25"></i>
                    </div>
                    <a href="modul/pesan/index.php" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <div class="mt-5 p-4 bg-light rounded-4 border border-dashed">
            <div class="text-muted small">
                <i class="bi bi-info-circle me-2"></i> <strong>Tips:</strong> Periksa Kotak Masuk secara berkala untuk menanggapi pertanyaan dari calon wali murid atau masyarakat.
            </div>
        </div>
    </div>
</div>

</body>
</html>