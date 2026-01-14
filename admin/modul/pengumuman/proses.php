<?php
require_once '../../../config/config.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$folder_doc = "../../../assets/doc/";

if($aksi == 'tambah'){
    $judul   = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi     = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal = $_POST['tanggal'];
    $status  = $_POST['status'];
    
    $nama_file = "";
    if(!empty($_FILES['dokumen']['name'])){
        // Gunakan time() agar nama file unik
        $nama_file = time() . "_" . $_FILES['dokumen']['name'];
        move_uploaded_file($_FILES['dokumen']['tmp_name'], $folder_doc . $nama_file);
    }

    $sql = "INSERT INTO pengumuman (judul, isi, dokumen, tanggal, status) VALUES ('$judul', '$isi', '$nama_file', '$tanggal', '$status')";
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id      = $_POST['id'];
    $judul   = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi     = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal = $_POST['tanggal'];
    $status  = $_POST['status'];
    $file    = $_FILES['dokumen']['name'];

    if(!empty($file)){
        // 1. Cari dan hapus dokumen lama jika ada
        $cek = mysqli_fetch_array(mysqli_query($conn, "SELECT dokumen FROM pengumuman WHERE id='$id'"));
        if(!empty($cek['dokumen']) && file_exists($folder_doc . $cek['dokumen'])) {
            unlink($folder_doc . $cek['dokumen']);
        }
        // 2. Upload dokumen baru
        $nama_baru = time() . "_" . $file;
        move_uploaded_file($_FILES['dokumen']['tmp_name'], $folder_doc . $nama_baru);
        
        $sql = "UPDATE pengumuman SET judul='$judul', isi='$isi', dokumen='$nama_baru', tanggal='$tanggal', status='$status' WHERE id='$id'";
    } else {
        $sql = "UPDATE pengumuman SET judul='$judul', isi='$isi', tanggal='$tanggal', status='$status' WHERE id='$id'";
    }
    
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'status'){
    $id = $_GET['id'];
    $set = $_GET['set'];
    mysqli_query($conn, "UPDATE pengumuman SET status='$set' WHERE id='$id'");
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    // Cari nama file sebelum data di database dihapus
    $cek = mysqli_fetch_array(mysqli_query($conn, "SELECT dokumen FROM pengumuman WHERE id='$id'"));
    if(!empty($cek['dokumen']) && file_exists($folder_doc . $cek['dokumen'])) {
        unlink($folder_doc . $cek['dokumen']);
    }
    
    mysqli_query($conn, "DELETE FROM pengumuman WHERE id='$id'");
    header("location:index.php");
}
?>