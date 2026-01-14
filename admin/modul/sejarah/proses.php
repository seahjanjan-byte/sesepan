<?php
include '../../../config/config.php';

if(isset($_POST['update'])){
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $path = "../../../assets/img/";

    if(!empty($gambar)){
        // 1. Cari dan hapus gambar lama
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM profil WHERE kategori='sejarah'"));
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) {
            unlink($path . $old['gambar']);
        }
        
        // 2. Upload gambar baru
        $nama_file = "sejarah_" . time() . "_" . $gambar;
        move_uploaded_file($tmp, $path . $nama_file);
        $sql = "UPDATE profil SET isi='$isi', gambar='$nama_file' WHERE kategori='sejarah'";
    } else {
        $sql = "UPDATE profil SET isi='$isi' WHERE kategori='sejarah'";
    }
    
    if(mysqli_query($conn, $sql)){
        header("location:../profil/index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("location:index.php");
}
?>