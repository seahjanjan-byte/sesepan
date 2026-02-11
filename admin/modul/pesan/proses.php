<?php
include '../../../config/config.php';
include '../../cek_session.php'; 

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$admin_id = $_SESSION['admin_id'];

if($aksi == 'pin'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $set = mysqli_real_escape_string($conn, $_GET['set']);
    // is_pinned menggunakan VARCHAR '0' atau '1'
    mysqli_query($conn, "UPDATE pesan SET is_pinned='$set', id_admin_pembaca='$admin_id' WHERE id_pesan='$id'");
    header("Location: index.php");
    exit();

} elseif($aksi == 'status'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $set = mysqli_real_escape_string($conn, $_GET['set']); 
    mysqli_query($conn, "UPDATE pesan SET status='$set', is_pinned='0', id_admin_pembaca='$admin_id' WHERE id_pesan='$id'");
    header("Location: index.php");
    exit();

} elseif($aksi == 'hapus'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    mysqli_query($conn, "DELETE FROM pesan WHERE id_pesan='$id'");
    header("Location: index.php");
    exit();
}
?>