<?php 
include '../../../config/config.php'; 
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM fasilitas WHERE id='$id'"));
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <title>Edit Fasilitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-warning"><h4>Edit Fasilitas</h4></div>
            <div class="card-body">
                <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Fasilitas</label>
                        <input type="text" name="nama_fasilitas" class="form-control" value="<?= $data['nama_fasilitas']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required><?= $data['deskripsi']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Sekarang</label><br>
                        <img src="../../../assets/img/<?= $data['gambar']; ?>" width="150" class="mb-2">
                        <input type="file" name="gambar" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-warning">Kemaskini</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>