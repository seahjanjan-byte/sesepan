<?php
include '../../../config/config.php';
include 'cek_session.php';

if(isset($_POST['update'])){
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = $_FILES['gambar']['name'];
    $path = "../../../assets/img/";

    if(!empty($gambar)){
        // 1. Hapus bagan lama
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM profil WHERE kategori='struktur'"));
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) {
            unlink($path . $old['gambar']);
        }
        
        // 2. Upload bagan baru
        $nama_file = "struktur_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_file);
        $sql = "UPDATE profil SET isi='$isi', gambar='$nama_file' WHERE kategori='struktur'";
    } else {
        $sql = "UPDATE profil SET isi='$isi' WHERE kategori='struktur'";
    }
    
    mysqli_query($conn, $sql);
    
    // REVISI: Diarahkan keluar ke halaman utama profil
    header("location:../profil/index.php?status=success");
    exit();
} else {
    // Jika diakses tanpa submit, kembalikan ke profil
    header("location:../profil/index.php");
    exit();
}
?>