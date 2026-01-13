<?php
include '../../../config/config.php';

if(isset($_POST['update'])){
    // Gabungkan array poin visi menjadi string tunggal
    $visi = isset($_POST['visi']) ? implode("[BREAK]", array_filter($_POST['visi'])) : "";
    // Gabungkan array poin misi menjadi string tunggal
    $misi = isset($_POST['misi']) ? implode("[BREAK]", array_filter($_POST['misi'])) : "";

    // Update masing-masing kategori
    mysqli_query($conn, "UPDATE profil SET isi='$visi' WHERE kategori='visi'");
    mysqli_query($conn, "UPDATE profil SET isi='$misi' WHERE kategori='misi'");

    echo "<script>alert('Visi & Misi berhasil diperbarui!'); window.location='index.php';</script>";
}
?>