<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    $status = $_POST['status'];
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    
    $nama_file = "brosur_" . time() . "_" . $gambar;
    move_uploaded_file($tmp, $path . $nama_file);
    
    mysqli_query($conn, "INSERT INTO ppdb (gambar, status) VALUES ('$nama_file', '$status')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id = $_POST['id'];
    $status = $_POST['status']; // Pastikan status juga diambil dari form
    $gambar = $_FILES['gambar']['name'];

    if(!empty($gambar)){
        $query = mysqli_query($conn, "SELECT gambar FROM ppdb WHERE id='$id'");
        $old = mysqli_fetch_array($query);
        if($old['gambar'] != "" && file_exists("../../../assets/img/".$old['gambar'])) unlink("../../../assets/img/".$old['gambar']);
        
        $nama_file = "brosur_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../../assets/img/".$nama_file);
        
        // Update gambar DAN status
        mysqli_query($conn, "UPDATE ppdb SET gambar='$nama_file', status='$status' WHERE id='$id'");
    } else {
        // Jika gambar kosong, tetap update statusnya
        mysqli_query($conn, "UPDATE ppdb SET status='$status' WHERE id='$id'");
    }
    header("location:index.php");
} elseif($aksi == 'status'){
    $id = $_GET['id'];
    $set = $_GET['set'];
    mysqli_query($conn, "UPDATE ppdb SET status='$set' WHERE id='$id'");
    header("location:index.php");
}
?>