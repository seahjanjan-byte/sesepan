<?php
include '../../../config/config.php'; 
include '../../cek_session.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    // LOGIKA GENERATE ID PPDB (PDB001)
    $query_id = mysqli_query($conn, "SELECT id_ppdb FROM ppdb ORDER BY id_ppdb DESC LIMIT 1");
    if(mysqli_num_rows($query_id) > 0) {
        $last_id = mysqli_fetch_array($query_id)['id_ppdb'];
        $num = (int)substr($last_id, 3) + 1;
        $id_baru = "PDB" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_baru = "PDB001";
    }

    $id_admin = $_SESSION['admin_id']; // Relasi ke Admin
    $status = $_POST['status'];
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    
    $nama_file = "brosur_" . time() . "_" . $gambar;
    move_uploaded_file($tmp, $path . $nama_file);
    
    // INSERT menyertakan id_ppdb dan id_admin sesuai aturan relasi
    mysqli_query($conn, "INSERT INTO ppdb (id_ppdb, id_admin, gambar, status) VALUES ('$id_baru', '$id_admin', '$nama_file', '$status')");
    header("Location: index.php");
    exit();

} elseif($aksi == 'edit'){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $id_admin = $_SESSION['admin_id']; // Catat admin yang melakukan update
    $status = $_POST['status'];
    $gambar = $_FILES['gambar']['name'];

    if(!empty($gambar)){
        // REVISI: Menggunakan id_ppdb
        $query = mysqli_query($conn, "SELECT gambar FROM ppdb WHERE id_ppdb='$id'");
        $old = mysqli_fetch_array($query);
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
        
        $nama_file = "brosur_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_file);
        
        // Update gambar, status, dan id_admin pembaharu
        mysqli_query($conn, "UPDATE ppdb SET gambar='$nama_file', status='$status', id_admin='$id_admin' WHERE id_ppdb='$id'");
    } else {
        mysqli_query($conn, "UPDATE ppdb SET status='$status', id_admin='$id_admin' WHERE id_ppdb='$id'");
    }
    header("Location: index.php");
    exit();

} elseif($aksi == 'status'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $set = mysqli_real_escape_string($conn, $_GET['set']);
    $id_admin = $_SESSION['admin_id'];
    mysqli_query($conn, "UPDATE ppdb SET status='$set', id_admin='$id_admin' WHERE id_ppdb='$id'");
    header("Location: index.php");
    exit();
}
?>