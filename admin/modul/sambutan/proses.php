<?php
include '../../../config/config.php';

if (isset($_POST['update'])) {
    $id    = $_POST['id'];
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);
    $file  = $_FILES['gambar']['name'];
    $tmp   = $_FILES['gambar']['tmp_name'];
    $path  = "../../../assets/img/";

    if (!empty($file)) {
        // 1. Hapus foto lama agar tidak membebani server
        $cek = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM profil WHERE id='$id'"));
        if ($cek['gambar'] != "" && file_exists($path . $cek['cek'])) {
            unlink($path . $cek['gambar']);
        }

        // 2. Upload foto baru
        $nama_baru = time() . "_" . $file;
        move_uploaded_file($tmp, $path . $nama_baru);

        // 3. Update dengan foto baru
        $query = "UPDATE profil SET isi='$isi', gambar='$nama_baru' WHERE id='$id'";
    } else {
        // Update hanya teks saja
        $query = "UPDATE profil SET isi='$isi' WHERE id='$id'";
    }

    if (mysqli_query($conn, $query)) {
        header("location:../../index.php?page=sambutan&status=success");
    } else {
        header("location:../../index.php?page=sambutan&status=failed");
    }
}
?>