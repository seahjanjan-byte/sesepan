<?php
include '../../../config/config.php';
include '../../cek_session.php'; ;
$aksi = $_GET['aksi'];
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama_fasilitas']);
    $desk = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = $_FILES['gambar']['name'];
    
    $nama_file = time() . "_" . $gambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_file);
    mysqli_query($conn, "INSERT INTO fasilitas (nama_fasilitas, deskripsi, gambar) VALUES ('$nama', '$desk', '$nama_file')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_fasilitas']);
    $desk = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = $_FILES['gambar']['name'];

    if($gambar != ""){
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM fasilitas WHERE id='$id'"));
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
        
        $nama_baru = time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_baru);
        $sql = "UPDATE fasilitas SET nama_fasilitas='$nama', deskripsi='$desk', gambar='$nama_baru' WHERE id='$id'";
    } else {
        $sql = "UPDATE fasilitas SET nama_fasilitas='$nama', deskripsi='$desk' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM fasilitas WHERE id='$id'"));
    if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
    
    mysqli_query($conn, "DELETE FROM fasilitas WHERE id='$id'");
    header("location:index.php");
}
?>