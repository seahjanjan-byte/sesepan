<?php
include '../../../config/config.php';
include '../../cek_session.php';

if(isset($_POST['update'])){
    $admin_id = $_SESSION['admin_id']; // Mengambil ID Admin dari session

    // Gabungkan array poin menjadi string dengan pemisah [BREAK]
    $visi = isset($_POST['visi']) ? mysqli_real_escape_string($conn, implode("[BREAK]", array_filter($_POST['visi']))) : "";
    $misi = isset($_POST['misi']) ? mysqli_real_escape_string($conn, implode("[BREAK]", array_filter($_POST['misi']))) : "";

    // 1. PROSES DATA VISI
    $cek_v = mysqli_query($conn, "SELECT id_profil FROM profil WHERE kategori='visi'");
    if(mysqli_num_rows($cek_v) > 0){
        // Jika sudah ada, update isi dan admin pengelola
        mysqli_query($conn, "UPDATE profil SET isi='$visi', id_admin='$admin_id' WHERE kategori='visi'");
    } else {
        // Jika belum ada, buat baris baru dengan ID String
        mysqli_query($conn, "INSERT INTO profil (id_profil, id_admin, kategori, judul, isi) 
                            VALUES ('PFL_VISI', '$admin_id', 'visi', 'Visi Sekolah', '$visi')");
    }

    // 2. PROSES DATA MISI
    $cek_m = mysqli_query($conn, "SELECT id_profil FROM profil WHERE kategori='misi'");
    if(mysqli_num_rows($cek_m) > 0){
        // Jika sudah ada, update
        mysqli_query($conn, "UPDATE profil SET isi='$misi', id_admin='$admin_id' WHERE kategori='misi'");
    } else {
        // Jika belum ada, buat baris baru
        mysqli_query($conn, "INSERT INTO profil (id_profil, id_admin, kategori, judul, isi) 
                            VALUES ('PFL_MISI', '$admin_id', 'misi', 'Misi Sekolah', '$misi')");
    }

    header("Location: ../profil/index.php?status=success");
    exit();

} else {
    header("Location: ../profil/index.php");
    exit();
}
?>