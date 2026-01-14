<?php
include '../../../config/config.php';
include '../../cek_session.php';
$aksi = $_GET['aksi'];
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = $_FILES['gambar']['name'];

    if(!empty($gambar)){
        $nama_file = "profil_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_file);
        mysqli_query($conn, "INSERT INTO profil (judul, isi, gambar) VALUES ('$judul', '$isi', '$nama_file')");
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
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
        
        $nama_baru = "profil_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_baru);
        $sql = "UPDATE profil SET isi='$isi', gambar='$nama_baru' WHERE id='$id'";
    } else {
        $sql = "UPDATE profil SET isi='$isi' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $d = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM profil WHERE id='$id'"));
    if(!empty($d['gambar']) && file_exists($path . $d['gambar'])) unlink($path . $d['gambar']);
    
    mysqli_query($conn, "DELETE FROM profil WHERE id='$id'");
    header("location:index.php");
}
?>