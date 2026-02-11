<?php
include '../../../config/config.php';
include '../../cek_session.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    // LOGIKA GENERATE ID GALERI (GLR001)
    $query_id = mysqli_query($conn, "SELECT id_galeri FROM galeri ORDER BY id_galeri DESC LIMIT 1");
    if(mysqli_num_rows($query_id) > 0) {
        $last_id = mysqli_fetch_array($query_id)['id_galeri'];
        $num = (int)substr($last_id, 3) + 1;
        $id_baru = "GLR" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_baru = "GLR001";
    }

    $id_admin = $_SESSION['admin_id']; // Relasi ke Admin
    $judul    = mysqli_real_escape_string($conn, $_POST['judul']);
    $kategori = $_POST['kategori'];
    $tipe     = $_POST['tipe_sumber'];
    $sumber   = "";

    if($tipe == 'upload'){
        $sumber = time() . "_" . $_FILES['file_sumber']['name'];
        move_uploaded_file($_FILES['file_sumber']['tmp_name'], $path . $sumber);
    } else {
        $sumber = mysqli_real_escape_string($conn, $_POST['url_sumber']);
    }

    // INSERT menyertakan id_galeri dan id_admin
    mysqli_query($conn, "INSERT INTO galeri (id_galeri, id_admin, judul, kategori, tipe_sumber, sumber) 
                        VALUES ('$id_baru', '$id_admin', '$judul', '$kategori', '$tipe', '$sumber')");
    header("Location: index.php");
    exit();

} elseif($aksi == 'edit'){
    $id       = mysqli_real_escape_string($conn, $_POST['id']);
    $judul    = mysqli_real_escape_string($conn, $_POST['judul']);
    $url_baru = mysqli_real_escape_string($conn, $_POST['url_sumber']);

    // REVISI: Menggunakan id_galeri
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM galeri WHERE id_galeri='$id'"));

    if(!empty($url_baru)){
        if($old['tipe_sumber'] == 'upload' && file_exists($path . $old['sumber'])) unlink($path . $old['sumber']);
        $sql = "UPDATE galeri SET judul='$judul', sumber='$url_baru' WHERE id_galeri='$id'";
    } else {
        $sql = "UPDATE galeri SET judul='$judul' WHERE id_galeri='$id'";
    }
    
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();

} elseif($aksi == 'hapus'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $d  = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM galeri WHERE id_galeri='$id'"));
    
    if($d['tipe_sumber'] == 'upload' && file_exists($path . $d['sumber'])) unlink($path . $d['sumber']);
    
    mysqli_query($conn, "DELETE FROM galeri WHERE id_galeri='$id'");
    header("Location: index.php");
    exit();
}
?>