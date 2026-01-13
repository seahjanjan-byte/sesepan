<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = $_FILES['gambar']['name'];

    if(!empty($gambar)){
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../../assets/img/".$gambar);
        mysqli_query($conn, "INSERT INTO profil (judul, isi, gambar) VALUES ('$judul', '$isi', '$gambar')");
    } else {
        mysqli_query($conn, "INSERT INTO profil (judul, isi) VALUES ('$judul', '$isi')");
    }
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id    = $_POST['id'];
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = $_FILES['gambar']['name'];

    if(!empty($gambar)){
        // Hapus gambar lama
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM profil WHERE id='$id'"));
        if($old['gambar'] && file_exists("../../../assets/img/".$old['gambar'])) unlink("../../../assets/img/".$old['gambar']);
        
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../../assets/img/".$gambar);
        $sql = "UPDATE profil SET isi='$isi', gambar='$gambar' WHERE id='$id'";
    } else {
        $sql = "UPDATE profil SET isi='$isi' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $d = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM profil WHERE id='$id'"));
    if($d['gambar'] && file_exists("../../../assets/img/".$d['gambar'])) unlink("../../../assets/img/".$d['gambar']);
    
    mysqli_query($conn, "DELETE FROM profil WHERE id='$id'");
    header("location:index.php");
}
?>