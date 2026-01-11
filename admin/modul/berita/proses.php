<?php
include '../../../config/config.php';

$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    // ... kode tambah yang kemarin ...

} elseif($aksi == 'edit'){
    $id    = $_POST['id'];
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);

    // Cek apakah user mengupload gambar baru
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    if($gambar != ""){
        // Jika upload gambar baru:
        // 1. Ambil nama gambar lama untuk dihapus
        $query_lama = mysqli_query($conn, "SELECT gambar FROM berita WHERE id='$id'");
        $data_lama  = mysqli_fetch_array($query_lama);
        
        // 2. Hapus file gambar lama dari folder (biar penyimpanan gak penuh)
        if(file_exists("../../../assets/img/".$data_lama['gambar'])){
            unlink("../../../assets/img/".$data_lama['gambar']);
        }

        // 3. Upload gambar baru & Update database
        move_uploaded_file($tmp, "../../../assets/img/".$gambar);
        $sql = "UPDATE berita SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id='$id'";
    } else {
        // Jika tidak ganti gambar, update data teks saja
        $sql = "UPDATE berita SET judul='$judul', isi='$isi' WHERE id='$id'";
    }

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Berita berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} elseif($aksi == 'hapus'){
    // ... kode hapus ...
}
?>