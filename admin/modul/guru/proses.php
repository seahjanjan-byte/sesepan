<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $foto = $_FILES['foto']['name'];
    
    move_uploaded_file($_FILES['foto']['tmp_name'], "../../../assets/img/".$foto);
    mysqli_query($conn, "INSERT INTO guru (nama, jabatan, foto) VALUES ('$nama', '$jabatan', '$foto')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $foto = $_FILES['foto']['name'];

    if($foto != ""){
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT foto FROM guru WHERE id='$id'"));
        if(file_exists("../../../assets/img/".$old['foto'])) unlink("../../../assets/img/".$old['foto']);
        
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../../assets/img/".$foto);
        $sql = "UPDATE guru SET nama='$nama', jabatan='$jabatan', foto='$foto' WHERE id='$id'";
    } else {
        $sql = "UPDATE guru SET nama='$nama', jabatan='$jabatan' WHERE id='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT foto FROM guru WHERE id='$id'"));
    if(file_exists("../../../assets/img/".$old['foto'])) unlink("../../../assets/img/".$old['foto']);
    
    mysqli_query($conn, "DELETE FROM guru WHERE id='$id'");
    header("location:index.php");
}
?>