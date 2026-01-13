<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $status = $_POST['status'];
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    
    $nama_file = "brosur_" . time() . "_" . $gambar;
    move_uploaded_file($tmp, "../../../assets/img/".$nama_file);
    
    mysqli_query($conn, "INSERT INTO ppdb (gambar, status) VALUES ('$nama_file', '$status')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id     = $_POST['id'];
    $gambar = $_FILES['gambar']['name'];

    if(!empty($gambar)){
        // 1. Ambil data lama untuk menghapus file fisiknya
        $query = mysqli_query($conn, "SELECT gambar FROM ppdb WHERE id='$id'");
        $old = mysqli_fetch_array($query);
        
        // 2. Hapus file lama jika ada
        if($old['gambar'] != "" && file_exists("../../../assets/img/".$old['gambar'])){
            unlink("../../../assets/img/".$old['gambar']);
        }
        
        // 3. Upload file baru
        $nama_file = "brosur_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../../assets/img/".$nama_file);
        
        // 4. Update database
        mysqli_query($conn, "UPDATE ppdb SET gambar='$nama_file' WHERE id='$id'");
    }
    
    header("location:index.php");

} elseif($aksi == 'status'){
    $id = $_GET['id'];
    $set = $_GET['set']; // 'buka' atau 'tutup'
    
    mysqli_query($conn, "UPDATE ppdb SET status='$set' WHERE id='$id'");
    header("location:index.php");
}
?>