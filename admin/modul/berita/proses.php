<?php
include '../../../config/config.php';
include '../../cek_session.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    // LOGIKA GENERATE ID BERITA (BRT001)
    $query_id = mysqli_query($conn, "SELECT id_berita FROM berita ORDER BY id_berita DESC LIMIT 1");
    if(mysqli_num_rows($query_id) > 0) {
        $last_id = mysqli_fetch_array($query_id)['id_berita'];
        $num = (int)substr($last_id, 3) + 1;
        $id_baru = "BRT" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_baru = "BRT001";
    }

    $id_admin = $_SESSION['admin_id'];
    $judul    = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi      = mysqli_real_escape_string($conn, $_POST['isi']);
    $foto     = $_FILES['gambar']['name'];
    
    if($foto != ""){
        $nama_file = time() . "_" . $foto;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_file);
    } else {
        $nama_file = "";
    }

    mysqli_query($conn, "INSERT INTO berita (id_berita, id_admin, judul, isi, gambar, status) 
                        VALUES ('$id_baru', '$id_admin', '$judul', '$isi', '$nama_file', 'tampil')");
    header("Location: index.php");
    exit();

} elseif($aksi == 'edit'){
    $id    = mysqli_real_escape_string($conn, $_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);
    $foto  = $_FILES['gambar']['name'];

    if($foto != ""){
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM berita WHERE id_berita='$id'"));
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
        
        $nama_baru = time() . "_" . $foto;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_baru);
        $sql = "UPDATE berita SET judul='$judul', isi='$isi', gambar='$nama_baru' WHERE id_berita='$id'";
    } else {
        $sql = "UPDATE berita SET judul='$judul', isi='$isi' WHERE id_berita='$id'";
    }
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();

} elseif($aksi == 'status'){
    // REVISI: Perbaikan fitur Status (Arsipkan/Tampilkan)
    $id  = mysqli_real_escape_string($conn, $_GET['id']);
    $set = mysqli_real_escape_string($conn, $_GET['set']);
    
    // Gunakan id_berita sesuai struktur revisi
    $query = "UPDATE berita SET status='$set' WHERE id_berita='$id'";
    mysqli_query($conn, $query);
    
    // Redirect kembali ke index dan hentikan eksekusi skrip
    header("Location: index.php");
    exit();

} elseif($aksi == 'hapus'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM berita WHERE id_berita='$id'"));
    if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
    
    mysqli_query($conn, "DELETE FROM berita WHERE id_berita='$id'");
    header("Location: index.php");
    exit();
}
?>