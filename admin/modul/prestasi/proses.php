<?php
include '../../../config/config.php';
include '../../cek_session.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    // LOGIKA GENERATE ID PRESTASI (PRS001)
    $query_id = mysqli_query($conn, "SELECT id_prestasi FROM prestasi ORDER BY id_prestasi DESC LIMIT 1");
    if(mysqli_num_rows($query_id) > 0) {
        $last_id = mysqli_fetch_array($query_id)['id_prestasi'];
        $num = (int)substr($last_id, 3) + 1;
        $id_baru = "PRS" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_baru = "PRS001";
    }

    $id_admin = $_SESSION['admin_id']; 
    $id_guru  = $_POST['id_guru'];
    $judul    = mysqli_real_escape_string($conn, $_POST['judul_prestasi']);
    $kategori = $_POST['kategori'];
    $tgl      = $_POST['tgl_prestasi'];
    $ket      = mysqli_real_escape_string($conn, $_POST['keterangan']);
    
    $gambar    = $_FILES['gambar']['name'];
    $nama_file = "prestasi_" . time() . "_" . $gambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_file);
    
    // INSERT menyertakan id_prestasi, id_admin, dan id_guru sesuai aturan relasi
    mysqli_query($conn, "INSERT INTO prestasi (id_prestasi, id_admin, id_guru, judul_prestasi, kategori, tgl_prestasi, keterangan, gambar) 
                         VALUES ('$id_baru', '$id_admin', '$id_guru', '$judul', '$kategori', '$tgl', '$ket', '$nama_file')");
    header("Location: index.php");
    exit();

} elseif($aksi == 'edit'){
    $id       = mysqli_real_escape_string($conn, $_POST['id']);
    $id_guru  = $_POST['id_guru'];
    $judul    = mysqli_real_escape_string($conn, $_POST['judul_prestasi']);
    $kategori = $_POST['kategori'];
    $tgl      = $_POST['tgl_prestasi'];
    $ket      = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $gambar   = $_FILES['gambar']['name'];

    if($gambar != ""){
        $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM prestasi WHERE id_prestasi='$id'"));
        if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
        
        $nama_baru = "prestasi_" . time() . "_" . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_baru);
        $sql = "UPDATE prestasi SET id_guru='$id_guru', judul_prestasi='$judul', kategori='$kategori', tgl_prestasi='$tgl', keterangan='$ket', gambar='$nama_baru' WHERE id_prestasi='$id'";
    } else {
        $sql = "UPDATE prestasi SET id_guru='$id_guru', judul_prestasi='$judul', kategori='$kategori', tgl_prestasi='$tgl', keterangan='$ket' WHERE id_prestasi='$id'";
    }
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();

} elseif($aksi == 'hapus'){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $old = mysqli_fetch_array(mysqli_query($conn, "SELECT gambar FROM prestasi WHERE id_prestasi='$id'"));
    if(!empty($old['gambar']) && file_exists($path . $old['gambar'])) unlink($path . $old['gambar']);
    
    mysqli_query($conn, "DELETE FROM prestasi WHERE id_prestasi='$id'");
    header("Location: index.php");
    exit();
}
?>