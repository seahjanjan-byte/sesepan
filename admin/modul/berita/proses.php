<?php
include '../../../config/config.php';

$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    // Mengambil data dari form tambah.php
    $judul  = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi    = mysqli_real_escape_string($conn, $_POST['isi']);
    
    // Logika Upload Gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    
    if($gambar != ""){
        // Pindahkan file ke folder assets/img/
        move_uploaded_file($tmp, "../../../assets/img/" . $gambar);
        // Tambahkan kolom 'status' dengan nilai default 'tampil'
        $sql = "INSERT INTO berita (judul, isi, gambar, status) VALUES ('$judul', '$isi', '$gambar', 'tampil')";
    } else {
        // Jika tidak ada gambar yang diupload
        $sql = "INSERT INTO berita (judul, isi, gambar, status) VALUES ('$judul', '$isi', '', 'tampil')";
    }

    if(mysqli_query($conn, $sql)){
        // Berhasil simpan, langsung alihkan kembali ke index berita
        echo "<script>alert('Berita berhasil diposting!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} elseif($aksi == 'edit'){
    $id    = $_POST['id'];
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    if($gambar != ""){
        // Hapus gambar lama agar tidak menumpuk di server
        $query_lama = mysqli_query($conn, "SELECT gambar FROM berita WHERE id='$id'");
        $data_lama  = mysqli_fetch_array($query_lama);
        
        if($data_lama['gambar'] != "" && file_exists("../../../assets/img/".$data_lama['gambar'])){
            unlink("../../../assets/img/".$data_lama['gambar']);
        }

        // Upload gambar baru
        move_uploaded_file($tmp, "../../../assets/img/".$gambar);
        $sql = "UPDATE berita SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id='$id'";
    } else {
        // Update tanpa ganti gambar
        $sql = "UPDATE berita SET judul='$judul', isi='$isi' WHERE id='$id'";
    }

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Berita berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    
    // Hapus file fisik gambar sebelum hapus data di database
    $query = mysqli_query($conn, "SELECT gambar FROM berita WHERE id='$id'");
    $data  = mysqli_fetch_array($query);
    if($data['gambar'] != "" && file_exists("../../../assets/img/".$data['gambar'])){
        unlink("../../../assets/img/".$data['gambar']);
    }

    $sql = "DELETE FROM berita WHERE id='$id'";
    if(mysqli_query($conn, $sql)){
        header("location:index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

// FITUR BARU: LOGIKA GANTI STATUS (ARSIP/TAMPIL)
} elseif($aksi == 'status'){
    $id = $_GET['id'];
    $set = $_GET['set']; // Mengambil nilai 'tampil' atau 'arsip' dari URL
    
    $sql = "UPDATE berita SET status='$set' WHERE id='$id'";
    if(mysqli_query($conn, $sql)){
        header("location:index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>