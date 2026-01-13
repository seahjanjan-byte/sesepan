<?php include '../../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Masuk - Admin SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <style>
        /* CSS Tambahan untuk Transisi dan Hover */
        .transition-all {
            transition: all 0.3s ease;
        }
        .nav-pill-wrapper .btn {
            border: none !important;
        }
        .btn-light.text-muted:hover {
            background-color: #f1f4f9;
            color: #3b82f6 !important;
        }
    </style>
</head>
<body style="background-color: #f8f9fa;">

<div class="main-wrapper">
    <?php include '../../sidebar.php'; ?>

    <div class="content-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0 text-dark">Manajemen Pesan</h3>
            
            <div class="p-1 bg-white border rounded-pill shadow-sm d-inline-flex nav-pill-wrapper">
                <?php 
                $view = isset($_GET['view']) ? $_GET['view'] : 'masuk'; 
                ?>
                <a href="index.php" class="btn <?= ($view == 'masuk') ? 'btn-primary shadow-sm' : 'btn-light text-muted'; ?> rounded-pill px-4 py-2 fw-bold transition-all">
                    <i class="bi bi-inbox-fill me-2"></i> Kotak Masuk
                </a>
                <a href="index.php?view=arsip" class="btn <?= ($view == 'arsip') ? 'btn-primary shadow-sm' : 'btn-light text-muted'; ?> rounded-pill px-4 py-2 fw-bold transition-all">
                    <i class="bi bi-archive-fill me-2"></i> Arsip
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-envelope-paper me-2"></i> 
                    <?= ($view == 'arsip') ? 'Pesan Diarsipkan' : 'Daftar Pesan Masuk'; ?>
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3" width="5%">No</th>
                                <th class="py-3">Pengirim</th>
                                <th class="py-3">Telepon / WA</th>
                                <th class="py-3">Subjek</th>
                                <th class="py-3 text-center" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $current_view = isset($_GET['view']) ? 'arsip' : 'aktif';
                            
                            if($current_view == 'arsip'){
                                $sql = mysqli_query($conn, "SELECT * FROM pesan WHERE status='arsip' ORDER BY tanggal DESC");
                            } else {
                                $sql = mysqli_query($conn, "SELECT * FROM pesan WHERE status!='arsip' ORDER BY is_pinned DESC, tanggal DESC");
                            }

                            if(mysqli_num_rows($sql) > 0):
                                while($d = mysqli_fetch_array($sql)){
                                    $wa_number = preg_replace('/[^0-9]/', '', $d['telepon']);
                                    if(substr($wa_number, 0, 1) === '0') $wa_number = '62' . substr($wa_number, 1);
                            ?>
                            <tr class="<?= ($d['is_pinned']) ? 'bg-warning-subtle' : ''; ?>">
                                <td class="px-4 text-center">
                                    <?php if($d['is_pinned']): ?>
                                        <i class="bi bi-pin-angle-fill text-danger"></i>
                                    <?php else: echo $no++; endif; ?>
                                </td>
                                <td>
                                    <div class="fw-bold"><?= $d['nama']; ?></div>
                                    <small class="text-muted"><?= $d['email']; ?></small>
                                </td>
                                <td>
                                    <span><?= $d['telepon']; ?></span>
                                    <a href="https://wa.me/<?= $wa_number; ?>" target="_blank" class="ms-2 text-success transition-all" title="Hubungi via WhatsApp">
                                        <i class="bi bi-whatsapp fs-5"></i>
                                    </a>
                                </td>
                                <td><?= $d['subjek']; ?></td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="detail.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-light border px-3" title="Baca"><i class="bi bi-eye"></i></a>
                                        
                                        <a href="proses.php?aksi=pin&id=<?= $d['id']; ?>&set=<?= ($d['is_pinned'] == 1) ? '0' : '1'; ?>" 
                                           class="btn btn-sm <?= ($d['is_pinned']) ? 'btn-warning' : 'btn-outline-warning'; ?> px-3" title="Pin Pesan">
                                            <i class="bi bi-pin-angle"></i>
                                        </a>

                                        <a href="proses.php?aksi=status&id=<?= $d['id']; ?>&set=<?= ($view == 'arsip') ? 'dibaca' : 'arsip'; ?>" 
                                           class="btn btn-sm btn-secondary px-3" title="<?= ($view == 'arsip') ? 'Kembalikan ke Inbox' : 'Arsipkan'; ?>">
                                            <i class="bi <?= ($view == 'arsip') ? 'bi-archive-fill' : 'bi-archive'; ?>"></i>
                                        </a>

                                        <a href="proses.php?aksi=hapus&id=<?= $d['id']; ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Hapus permanen?')"><i class="bi bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php } else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada pesan masuk.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>