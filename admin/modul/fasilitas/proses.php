<?php
include '../../../config/config.php';
include '../../cek_session.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    // LOGIKA GENERATE ID FASILITAS (FSL001)
    $query_id = mysqli_query($conn, "SELECT id_fasilitas FROM fasilitas ORDER BY id_fasilitas DESC LIMIT 1");
    if(mysqli_num_rows($query_id) > 0) {
        $last_id = mysqli_fetch_array($query_id)['id_fasilitas'];
        $num = (int)substr($last_id, 3) + 1;
        $id_baru = "FSL" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_baru = "FSL001";
    }

    $id_admin = $_SESSION['admin_id']; // Relasi ke Admin
    $nama = mysqli_real_escape_string($conn, $_POST['nama_fasilitas']);
    $desk = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = $_FILES['gambar']['name'];
    
    $nama_file = time() . "_" . $gambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_file);

    // INSERT menyertakan id_fasilitas dan id_admin
    mysqli_query($conn, "INSERT INTO fasilitas (id_fasilitas, id_admin, nama_fasilitas, deskripsi, gambar) 
                        VALUES ('$id_baru', '$id_admin', '$nama', '$desk', '$nama_file')");
    header("Location: index.php");
    exit();

} elseif($aksi == 'edit'){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_fasilitas']);
    $desk = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = $_FILES['gambar']['name'];

    if($gambar != ""){
        // REVISI: Menggunakan id_fasilitas
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM fasilitas WHERE id_fasilitas='$id'"));
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
        
        $nama_baru = time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_baru);
        $sql = "UPDATE fasilitas SET nama_fasilitas='$nama', deskripsi='$desk', gambar='$nama_baru' WHERE id_fasilitas='$id'";
    } else {
        $sql = "UPDATE fasilitas SET nama_fasilitas='$nama', deskripsi='$desk' WHERE id_fasilitas='$id'";
    }
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();

} elseif($aksi == 'hapus'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM fasilitas WHERE id_fasilitas='$id'"));
    if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
    
    mysqli_query($conn, "DELETE FROM fasilitas WHERE id_fasilitas='$id'");
    header("Location: index.php");
    exit();
}
?>