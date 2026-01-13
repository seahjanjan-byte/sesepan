<?php
include '../../../config/config.php';

if(isset($_POST['update'])){
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = $_FILES['gambar']['name'];

    if(!empty($gambar)){
        // Hapus file lama jika ada
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM profil WHERE kategori='struktur'"));
        if($old['gambar'] && file_exists("../../../assets/img/".$old['gambar'])) unlink("../../../assets/img/".$old['gambar']);
        
        $nama_file = "struktur_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../../assets/img/".$nama_file);
        $sql = "UPDATE profil SET isi='$isi', gambar='$nama_file' WHERE kategori='struktur'";
    } else {
        $sql = "UPDATE profil SET isi='$isi' WHERE kategori='struktur'";
    }
    
    mysqli_query($conn, $sql);
    header("location:index.php");
}
?>