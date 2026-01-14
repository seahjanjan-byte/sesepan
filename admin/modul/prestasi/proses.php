<?php
include '../../../config/config.php';
include 'cek_session.php';
$aksi = $_GET['aksi'];
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    $judul    = mysqli_real_escape_string($conn, $_POST['judul_prestasi']);
    $kategori = $_POST['kategori']; // Menangkap kategori
    $tgl      = $_POST['tgl_prestasi'];
    $ket      = mysqli_real_escape_string($conn, $_POST['keterangan']);
    
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    
    $nama_file = "prestasi_" . time() . "_" . $gambar;
    move_uploaded_file($tmp, $path . $nama_file);
    
    // Query INSERT dengan kolom kategori
    mysqli_query($conn, "INSERT INTO prestasi (judul_prestasi, kategori, tgl_prestasi, keterangan, gambar) 
                         VALUES ('$judul', '$kategori', '$tgl', '$ket', '$nama_file')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id       = $_POST['id'];
    $judul    = mysqli_real_escape_string($conn, $_POST['judul_prestasi']);
    $kategori = $_POST['kategori']; // Menangkap kategori
    $tgl      = $_POST['tgl_prestasi'];
    $ket      = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $gambar   = $_FILES['gambar']['name'];

    if($gambar != ""){
        // Hapus gambar lama
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM prestasi WHERE id='$id'"));
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
        
        $nama_baru = "prestasi_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_baru);
        
        // Query UPDATE dengan kolom kategori
        $sql = "UPDATE prestasi SET judul_prestasi='$judul', kategori='$kategori', tgl_prestasi='$tgl', keterangan='$ket', gambar='$nama_baru' WHERE id='$id'";
    } else {
        // Query UPDATE kategori tanpa ganti gambar
        $sql = "UPDATE prestasi SET judul_prestasi='$judul', kategori='$kategori', tgl_prestasi='$tgl', keterangan='$ket' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM prestasi WHERE id='$id'"));
    if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
    
    mysqli_query($conn, "DELETE FROM prestasi WHERE id='$id'");
    header("location:index.php");
}
?>