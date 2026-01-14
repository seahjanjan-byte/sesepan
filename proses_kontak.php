<?php
include 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon   = mysqli_real_escape_string($conn, $_POST['telepon']);
    $subjek    = mysqli_real_escape_string($conn, $_POST['subjek']);
    $isi_pesan = mysqli_real_escape_string($conn, $_POST['isi_pesan']);
    $tanggal   = date('Y-m-d H:i:s');

    // Query menyimpan pesan
    $query = "INSERT INTO pesan (nama, email, telepon, subjek, isi_pesan, tanggal, status, is_pinned) 
              VALUES ('$nama', '$email', '$telepon', '$subjek', '$isi_pesan', '$tanggal', 'aktif', '0')";

    if (mysqli_query($conn, $query)) {
        // REVISI: Kembali ke index.php dan arahkan ke id section kontak
        header("location:index.php?status=terkirim#hubungi-kami");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("location:index.php");
    exit();
}
?>