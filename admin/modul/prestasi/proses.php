<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $judul = mysqli_real_escape_string($conn, $_POST['judul_prestasi']);
    $tgl   = $_POST['tgl_prestasi'];
    $ket   = mysqli_real_escape_string($conn, $_POST['keterangan']);
    
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    
    move_uploaded_file($tmp, "../../../assets/img/".$gambar);
    mysqli_query($conn, "INSERT INTO prestasi (judul_prestasi, tgl_prestasi, keterangan, gambar) VALUES ('$judul', '$tgl', '$ket', '$gambar')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id    = $_POST['id'];
    $judul = mysqli_real_escape_string($conn, $_POST['judul_prestasi']);
    $tgl   = $_POST['tgl_prestasi'];
    $ket   = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $gambar = $_FILES['gambar']['name'];

    if($gambar != ""){
        // Hapus gambar lama
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM prestasi WHERE id='$id'"));
        if(file_exists("../../../assets/img/".$old['gambar'])) unlink("../../../assets/img/".$old['gambar']);
        
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../../assets/img/".$gambar);
        $sql = "UPDATE prestasi SET judul_prestasi='$judul', tgl_prestasi='$tgl', keterangan='$ket', gambar='$gambar' WHERE id='$id'";
    } else {
        $sql = "UPDATE prestasi SET judul_prestasi='$judul', tgl_prestasi='$tgl', keterangan='$ket' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM prestasi WHERE id='$id'"));
    if(file_exists("../../../assets/img/".$old['gambar'])) unlink("../../../assets/img/".$old['gambar']);
    
    mysqli_query($conn, "DELETE FROM prestasi WHERE id='$id'");
    header("location:index.php");
}
?>