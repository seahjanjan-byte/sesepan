<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama_fasilitas']);
    $desk = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = $_FILES['gambar']['name'];
    
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../../../assets/img/".$gambar);
    mysqli_query($conn, "INSERT INTO fasilitas (nama_fasilitas, deskripsi, gambar) VALUES ('$nama', '$desk', '$gambar')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_fasilitas']);
    $desk = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = $_FILES['gambar']['name'];

    if($gambar != ""){
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM fasilitas WHERE id='$id'"));
        if(file_exists("../../../assets/img/".$old['gambar'])) unlink("../../../assets/img/".$old['gambar']);
        
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../../assets/img/".$gambar);
        $sql = "UPDATE fasilitas SET nama_fasilitas='$nama', deskripsi='$desk', gambar='$gambar' WHERE id='$id'";
    } else {
        $sql = "UPDATE fasilitas SET nama_fasilitas='$nama', deskripsi='$desk' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM fasilitas WHERE id='$id'"));
    if(file_exists("../../../assets/img/".$old['gambar'])) unlink("../../../assets/img/".$old['gambar']);
    
    mysqli_query($conn, "DELETE FROM fasilitas WHERE id='$id'");
    header("location:index.php");
}
?>