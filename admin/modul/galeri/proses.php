<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $kategori = $_POST['kategori'];
    $tipe = $_POST['tipe_sumber'];
    $sumber = "";

    if($tipe == 'upload'){
        $sumber = time() . "_" . $_FILES['file_sumber']['name'];
        move_uploaded_file($_FILES['file_sumber']['tmp_name'], $path . $sumber);
    } else {
        $sumber = mysqli_real_escape_string($conn, $_POST['url_sumber']);
    }

    mysqli_query($conn, "INSERT INTO galeri (judul, kategori, tipe_sumber, sumber) VALUES ('$judul', '$kategori', '$tipe', '$sumber')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id = $_POST['id'];
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $url_baru = mysqli_real_escape_string($conn, $_POST['url_sumber']);

    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM galeri WHERE id='$id'"));

    if(!empty($url_baru)){
        // Hapus file fisik jika sumber sebelumnya adalah file upload
        if($old['tipe_sumber'] == 'upload' && file_exists($path . $old['sumber'])) unlink($path . $old['sumber']);
        $sql = "UPDATE galeri SET judul='$judul', sumber='$url_baru' WHERE id='$id'";
    } else {
        $sql = "UPDATE galeri SET judul='$judul' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $d = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM galeri WHERE id='$id'"));
    
    if($d['tipe_sumber'] == 'upload' && file_exists($path . $d['sumber'])) unlink($path . $d['sumber']);
    
    mysqli_query($conn, "DELETE FROM galeri WHERE id='$id'");
    header("location:index.php");
}
?>