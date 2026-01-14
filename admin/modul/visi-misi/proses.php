<?php
include '../../../config/config.php';
include '../../cek_session.php';

if(isset($_POST['update'])){
    // Menggabungkan poin-poin visi dan misi menjadi string dengan pemisah [BREAK]
    $visi = isset($_POST['visi']) ? implode("[BREAK]", array_filter($_POST['visi'])) : "";
    $misi = isset($_POST['misi']) ? implode("[BREAK]", array_filter($_POST['misi'])) : "";

    // Melakukan update ke database
    mysqli_query($conn, "UPDATE profil SET isi='$visi' WHERE kategori='visi'");
    mysqli_query($conn, "UPDATE profil SET isi='$misi' WHERE kategori='misi'");

    // REVISI: Menghapus echo script alert dan langsung redirect ke halaman profil
    header("location:../profil/index.php?status=success");
    exit();
} else {
    // Jika diakses tanpa post, kembalikan ke halaman profil
    header("location:../profil/index.php");
    exit();
}
?>