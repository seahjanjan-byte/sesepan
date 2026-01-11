<?php 
include '../../../config/config.php'; 

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id = '$id'");
$data = mysqli_fetch_array($query);

// Jika data tidak ditemukan
if(mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan...");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Berita - SDN Sesepan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h4 class="mb-0">Edit Berita</h4>
            </div>
            <div class="card-body">
                <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Berita</label>
                        <textarea name="isi" class="form-control" rows="8" required><?= $data['isi']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <?php if($data['gambar'] != ""): ?>
                            <img src="../../../assets/img/<?= $data['gambar']; ?>" width="150" class="mb-2 rounded shadow-sm">
                        <?php else: ?>
                            <p class="text-muted small">Tidak ada gambar sebelumnya.</p>
                        <?php endif; ?>
                        
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <div class="form-text">Biarkan kosong jika tidak ingin mengganti gambar.</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update" class="btn btn-warning">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>