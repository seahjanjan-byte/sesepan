<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];

if($aksi == 'pin'){
    $id = $_GET['id'];
    $set = $_GET['set'];
    mysqli_query($conn, "UPDATE pesan SET is_pinned='$set' WHERE id='$id'");
    header("location:index.php");

} elseif($aksi == 'status'){
    $id = $_GET['id'];
    $set = $_GET['set']; // bisa 'arsip' atau 'dibaca'
    mysqli_query($conn, "UPDATE pesan SET status='$set', is_pinned='0' WHERE id='$id'");
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM pesan WHERE id='$id'");
    header("location:index.php");
}
?>