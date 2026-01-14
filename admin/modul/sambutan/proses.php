<?php
include '../../../config/config.php';
include 'cek_session.php';

if (isset($_POST['update'])) {
    $id    = $_POST['id'];
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);
    $file  = $_FILES['gambar']['name'];
    $tmp   = $_FILES['gambar']['tmp_name'];
    $path  = "../../../assets/img/";

    if (!empty($file)) {
        // 1. Ambil data lama untuk menghapus fotonya
        $cek = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM profil WHERE id='$id'"));
        // Perbaikan: Ganti $cek['cek'] menjadi $cek['gambar']
        if ($cek['gambar'] != "" && file_exists($path . $cek['gambar'])) {
            unlink($path . $cek['gambar']);
        }

        // 2. Upload foto baru dengan nama unik
        $nama_baru = time() . "_" . $file;
        move_uploaded_file($tmp, $path . $nama_baru);

        $query = "UPDATE profil SET isi='$isi', gambar='$nama_baru' WHERE id='$id'";
    } else {
        $query = "UPDATE profil SET isi='$isi' WHERE id='$id'";
    }

    mysqli_query($conn, $query);
    header("location:../../index.php?page=sambutan&status=success");
}
?>