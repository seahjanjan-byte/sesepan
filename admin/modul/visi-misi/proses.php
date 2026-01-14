<?php
include '../../../config/config.php';

if(isset($_POST['update'])){
    $visi = isset($_POST['visi']) ? implode("[BREAK]", array_filter($_POST['visi'])) : "";
    $misi = isset($_POST['misi']) ? implode("[BREAK]", array_filter($_POST['misi'])) : "";

    mysqli_query($conn, "UPDATE profil SET isi='$visi' WHERE kategori='visi'");
    mysqli_query($conn, "UPDATE profil SET isi='$misi' WHERE kategori='misi'");

    echo "<script>alert('Visi & Misi berhasil diperbarui!'); window.location='index.php';</script>";
}
?>