<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $foto = $_FILES['foto']['name'];
    
    $nama_file = time() . "_" . $foto;
    move_uploaded_file($_FILES['foto']['tmp_name'], $path . $nama_file);
    mysqli_query($conn, "INSERT INTO guru (nama, jabatan, foto) VALUES ('$nama', '$jabatan', '$nama_file')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $foto = $_FILES['foto']['name'];

    if($foto != ""){
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT foto FROM guru WHERE id='$id'"));
        if(!empty($old['foto']) && file_exists($path . $old['foto'])) unlink($path . $old['foto']);
        
        $nama_baru = time() . "_" . $foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $path . $nama_baru);
        $sql = "UPDATE guru SET nama='$nama', jabatan='$jabatan', foto='$nama_baru' WHERE id='$id'";
    } else {
        $sql = "UPDATE guru SET nama='$nama', jabatan='$jabatan' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT foto FROM guru WHERE id='$id'"));
    if(!empty($old['foto']) && file_exists($path . $old['foto'])) unlink($path . $old['foto']);
    
    mysqli_query($conn, "DELETE FROM guru WHERE id='$id'");
    header("location:index.php");
}
?>