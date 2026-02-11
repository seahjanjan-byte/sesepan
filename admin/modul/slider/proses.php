<?php
include '../../../config/config.php';
include '../../cek_session.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$admin_id = $_SESSION['admin_id']; // Relasi ke Admin
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    // LOGIKA GENERATE ID SLIDER (SLD001)
    $query_id = mysqli_query($conn, "SELECT id_slider FROM slider ORDER BY id_slider DESC LIMIT 1");
    if(mysqli_num_rows($query_id) > 0) {
        $last_id = mysqli_fetch_array($query_id)['id_slider'];
        $num = (int)substr($last_id, 3) + 1;
        $id_baru = "SLD" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_baru = "SLD001";
    }

    $judul    = mysqli_real_escape_string($conn, $_POST['judul']);
    $subjudul = mysqli_real_escape_string($conn, $_POST['subjudul']);
    $gambar   = $_FILES['gambar']['name'];
    $tmp      = $_FILES['gambar']['tmp_name'];
    
    $nama_file = "slide_" . time() . "_" . $gambar;
    if(move_uploaded_file($tmp, $path . $nama_file)){
        // INSERT menyertakan id_slider dan id_admin
        mysqli_query($conn, "INSERT INTO slider (id_slider, id_admin, judul, subjudul, gambar) 
                            VALUES ('$id_baru', '$admin_id', '$judul', '$subjudul', '$nama_file')");
        header("Location: index.php");
        exit();
    }

} elseif($aksi == 'edit'){
    $id       = mysqli_real_escape_string($conn, $_POST['id']);
    $judul    = mysqli_real_escape_string($conn, $_POST['judul']);
    $subjudul = mysqli_real_escape_string($conn, $_POST['subjudul']);
    $gambar   = $_FILES['gambar']['name'];

    if(!empty($gambar)){
        // REVISI: Menggunakan id_slider
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM slider WHERE id_slider='$id'"));
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
        
        $nama_file = "slide_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_file);
        $sql = "UPDATE slider SET judul='$judul', subjudul='$subjudul', gambar='$nama_file', id_admin='$admin_id' WHERE id_slider='$id'";
    } else {
        $sql = "UPDATE slider SET judul='$judul', subjudul='$subjudul', id_admin='$admin_id' WHERE id_slider='$id'";
    }
    
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();

} elseif($aksi == 'hapus'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $d = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM slider WHERE id_slider='$id'"));
    if(!empty($d['gambar']) && file_exists($path . $d['gambar'])) unlink($path . $d['gambar']);
    
    mysqli_query($conn, "DELETE FROM slider WHERE id_slider='$id'");
    header("Location: index.php");
    exit();
}
?>