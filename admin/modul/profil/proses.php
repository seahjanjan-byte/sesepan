<?php
include '../../../config/config.php';
include '../../cek_session.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$admin_id = $_SESSION['admin_id'];
$path = "../../../assets/img/";

if($aksi == 'tambah'){
    // Generate ID
    $query_id = mysqli_query($conn, "SELECT id_profil FROM profil ORDER BY id_profil DESC LIMIT 1");
    if(mysqli_num_rows($query_id) > 0) {
        $last_id = mysqli_fetch_array($query_id)['id_profil'];
        $num = (int)substr($last_id, 3) + 1;
        $id_baru = "PFL" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_baru = "PFL001";
    }

    $kategori = $_POST['kategori'];
    $judul    = ucfirst($kategori);
    
    // Ambil isi berdasarkan jenis input
    if($kategori == 'visi' || $kategori == 'misi'){
        $isi = isset($_POST['poin']) ? implode("[BREAK]", array_filter($_POST['poin'])) : "";
    } else {
        $isi = mysqli_real_escape_string($conn, $_POST['isi_biasa']);
    }

    // Gambar (Hanya diproses jika ada file diunggah)
    $nama_file = NULL;
    if(!empty($_FILES['gambar']['name'])){
        $nama_file = $kategori . "_" . time() . "_" . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path . $nama_file);
    }

    // Insert ke Database
    $query = "INSERT INTO profil (id_profil, id_admin, kategori, judul, isi, gambar) 
              VALUES ('$id_baru', '$admin_id', '$kategori', '$judul', '$isi', ".($nama_file ? "'$nama_file'" : "NULL").")";
    
    mysqli_query($conn, $query);
    header("Location: index.php");
    exit();
}
?>