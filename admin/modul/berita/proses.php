<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    $judul  = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi    = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    
    if($gambar != ""){
        $nama_file = time() . "_" . $gambar;
        move_uploaded_file($tmp, $path . $nama_file);
        $sql = "INSERT INTO berita (judul, isi, gambar, status) VALUES ('$judul', '$isi', '$nama_file', 'tampil')";
    } else {
        $sql = "INSERT INTO berita (judul, isi, gambar, status) VALUES ('$judul', '$isi', '', 'tampil')";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id    = $_POST['id'];
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = $_FILES['gambar']['name'];

    if($gambar != ""){
        // Hapus file lama sebelum upload yang baru
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM berita WHERE id='$id'"));
        if($old['gambar'] != "" && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);

        $nama_baru = time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_baru);
        $sql = "UPDATE berita SET judul='$judul', isi='$isi', gambar='$nama_baru' WHERE id='$id'";
    } else {
        $sql = "UPDATE berita SET judul='$judul', isi='$isi' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $data = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM berita WHERE id='$id'"));
    if($data['gambar'] != "" && file_exists($path . $data['gambar'])) unlink($path . $data['gambar']);

    mysqli_query($conn, "DELETE FROM berita WHERE id='$id'");
    header("location:index.php");

} elseif($aksi == 'status'){
    $id = $_GET['id'];
    $set = $_GET['set'];
    mysqli_query($conn, "UPDATE berita SET status='$set' WHERE id='$id'");
    header("location:index.php");
}
?>