<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $judul    = mysqli_real_escape_string($conn, $_POST['judul']);
    $subjudul = mysqli_real_escape_string($conn, $_POST['subjudul']);
    $gambar   = $_FILES['gambar']['name'];
    $tmp      = $_FILES['gambar']['tmp_name'];
    
    $nama_file = "slide_" . time() . "_" . $gambar;
    if(move_uploaded_file($tmp, "../../../assets/img/" . $nama_file)){
        mysqli_query($conn, "INSERT INTO slider (judul, subjudul, gambar) VALUES ('$judul', '$subjudul', '$nama_file')");
        header("location:index.php");
    }

} elseif($aksi == 'edit'){
    $id       = $_POST['id'];
    $judul    = mysqli_real_escape_string($conn, $_POST['judul']);
    $subjudul = mysqli_real_escape_string($conn, $_POST['subjudul']);
    $gambar   = $_FILES['gambar']['name'];

    if(!empty($gambar)){
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM slider WHERE id='$id'"));
        if(file_exists("../../../assets/img/".$old['gambar'])) unlink("../../../assets/img/".$old['gambar']);
        
        $nama_file = "slide_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../../assets/img/" . $nama_file);
        $sql = "UPDATE slider SET judul='$judul', subjudul='$subjudul', gambar='$nama_file' WHERE id='$id'";
    } else {
        $sql = "UPDATE slider SET judul='$judul', subjudul='$subjudul' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $d = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM slider WHERE id='$id'"));
    if(file_exists("../../../assets/img/".$d['gambar'])) unlink("../../../assets/img/".$d['gambar']);
    
    mysqli_query($conn, "DELETE FROM slider WHERE id='$id'");
    header("location:index.php");
}
?>