<?php
require_once '../../../config/config.php';
include '../../cek_session.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$folder_doc = "../../../assets/doc/";

if($aksi == 'tambah'){
    // LOGIKA GENERATE ID PENGUMUMAN (PGM001)
    $query_id = mysqli_query($conn, "SELECT id_pengumuman FROM pengumuman ORDER BY id_pengumuman DESC LIMIT 1");
    if(mysqli_num_rows($query_id) > 0) {
        $last_id = mysqli_fetch_array($query_id)['id_pengumuman'];
        $num = (int)substr($last_id, 3) + 1;
        $id_baru = "PGM" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_baru = "PGM001";
    }

    $id_admin = $_SESSION['admin_id']; // Relasi ke Admin
    $judul   = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi     = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal = $_POST['tanggal'];
    $status  = $_POST['status'];
    
    $nama_file = "";
    if(!empty($_FILES['dokumen']['name'])){
        $nama_file = time() . "_" . $_FILES['dokumen']['name'];
        move_uploaded_file($_FILES['dokumen']['tmp_name'], $folder_doc . $nama_file);
    }

    // INSERT menyertakan id_pengumuman dan id_admin
    $sql = "INSERT INTO pengumuman (id_pengumuman, id_admin, judul, isi, dokumen, tanggal, status) 
            VALUES ('$id_baru', '$id_admin', '$judul', '$isi', '$nama_file', '$tanggal', '$status')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();

} elseif($aksi == 'edit'){
    $id      = mysqli_real_escape_string($conn, $_POST['id']);
    $judul   = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi     = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal = $_POST['tanggal'];
    $status  = $_POST['status'];
    $file    = $_FILES['dokumen']['name'];

    if(!empty($file)){
        // REVISI: Menggunakan id_pengumuman
        $cek = mysqli_fetch_array(mysqli_query($conn, "SELECT dokumen FROM pengumuman WHERE id_pengumuman='$id'"));
        if(!empty($cek['dokumen']) && file_exists($folder_doc . $cek['dokumen'])) {
            unlink($folder_doc . $cek['dokumen']);
        }
        $nama_baru = time() . "_" . $file;
        move_uploaded_file($_FILES['dokumen']['tmp_name'], $folder_doc . $nama_baru);
        
        $sql = "UPDATE pengumuman SET judul='$judul', isi='$isi', dokumen='$nama_baru', tanggal='$tanggal', status='$status' WHERE id_pengumuman='$id'";
    } else {
        $sql = "UPDATE pengumuman SET judul='$judul', isi='$isi', tanggal='$tanggal', status='$status' WHERE id_pengumuman='$id'";
    }
    
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();

} elseif($aksi == 'status'){
    $id  = mysqli_real_escape_string($conn, $_GET['id']);
    $set = mysqli_real_escape_string($conn, $_GET['set']);
    mysqli_query($conn, "UPDATE pengumuman SET status='$set' WHERE id_pengumuman='$id'");
    header("Location: index.php");
    exit();

} elseif($aksi == 'hapus'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $cek = mysqli_fetch_array(mysqli_query($conn, "SELECT dokumen FROM pengumuman WHERE id_pengumuman='$id'"));
    if(!empty($cek['dokumen']) && file_exists($folder_doc . $cek['dokumen'])) {
        unlink($folder_doc . $cek['dokumen']);
    }
    
    mysqli_query($conn, "DELETE FROM pengumuman WHERE id_pengumuman='$id'");
    header("Location: index.php");
    exit();
}
?>