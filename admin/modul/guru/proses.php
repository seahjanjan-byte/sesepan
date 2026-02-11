<?php
include '../../../config/config.php';
include '../../cek_session.php'; 
$aksi = $_GET['aksi'];
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    // LOGIKA GENERATE ID GURU (GRUxxx)
    $query_id = mysqli_query($conn, "SELECT id_guru FROM guru ORDER BY id_guru DESC LIMIT 1");
    if(mysqli_num_rows($query_id) > 0) {
        $last_id = mysqli_fetch_array($query_id)['id_guru'];
        $num = (int)substr($last_id, 3) + 1;
        $id_baru = "GRU" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_baru = "GRU001";
    }

    $id_admin = $_SESSION['admin_id']; // Mengambil ID Admin dari session
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $foto = $_FILES['foto']['name'];
    
    $nama_file = time() . "_" . $foto;
    move_uploaded_file($_FILES['foto']['tmp_name'], $path . $nama_file);

    // Query menyertakan id_guru dan id_admin sesuai aturan relasi
    mysqli_query($conn, "INSERT INTO guru (id_guru, id_admin, nama, jabatan, foto) 
                        VALUES ('$id_baru', '$id_admin', '$nama', '$jabatan', '$nama_file')");
    header("location:index.php");

} elseif($aksi == 'edit'){
    $id = $_POST['id']; // id_guru (String)
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $foto = $_FILES['foto']['name'];

    if($foto != ""){
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT foto FROM guru WHERE id_guru='$id'"));
        if(!empty($old['foto']) && file_exists($path . $old['foto'])) unlink($path . $old['foto']);
        
        $nama_baru = time() . "_" . $foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $path . $nama_baru);
        $sql = "UPDATE guru SET nama='$nama', jabatan='$jabatan', foto='$nama_baru' WHERE id_guru='$id'";
    } else {
        $sql = "UPDATE guru SET nama='$nama', jabatan='$jabatan' WHERE id_guru='$id'";
    }
    mysqli_query($conn, $sql);
    header("location:index.php");

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT foto FROM guru WHERE id_guru='$id'"));
    if(!empty($old['foto']) && file_exists($path . $old['foto'])) unlink($path . $old['foto']);
    
    mysqli_query($conn, "DELETE FROM guru WHERE id_guru='$id'");
    header("location:index.php");
}
?>