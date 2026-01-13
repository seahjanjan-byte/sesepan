<?php
include '../../../config/config.php';
$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $kategori = $_POST['kategori'];
    $tipe = $_POST['tipe_sumber'];
    $sumber = "";

    if($tipe == 'upload'){
        $sumber = $_FILES['file_sumber']['name'];
        move_uploaded_file($_FILES['file_sumber']['tmp_name'], "../../../assets/img/".$sumber);
    } else {
        $sumber = mysqli_real_escape_string($conn, $_POST['url_sumber']);
    }

    $query = "INSERT INTO galeri (judul, kategori, tipe_sumber, sumber) VALUES ('$judul', '$kategori', '$tipe', '$sumber')";
    
    if(mysqli_query($conn, $query)){
        header("location:index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} elseif($aksi == 'edit'){
    $id = $_POST['id'];
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $url_baru = mysqli_real_escape_string($conn, $_POST['url_sumber']);

    // 1. Ambil data lama untuk pengecekan file
    $query_lama = mysqli_query($conn, "SELECT * FROM galeri WHERE id='$id'");
    $d = mysqli_fetch_array($query_lama);

    // 2. Logika jika ada perubahan sumber (baik link baru atau upload ulang)
    if(!empty($url_baru)){
        // Jika sebelumnya adalah file upload, hapus file lamanya dulu
        if($d['tipe_sumber'] == 'upload' && file_exists("../../../assets/img/".$d['sumber'])){
            unlink("../../../assets/img/".$d['sumber']);
        }
        // Update dengan link baru
        $sql = "UPDATE galeri SET judul='$judul', sumber='$url_baru' WHERE id='$id'";
    } else {
        // Jika hanya ubah judul saja
        $sql = "UPDATE galeri SET judul='$judul' WHERE id='$id'";
    }

    // 3. Eksekusi dan Redirect
    if(mysqli_query($conn, $sql)){
        header("location:index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} elseif($aksi == 'hapus'){
    $id = $_GET['id'];
    $d = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM galeri WHERE id='$id'"));
    
    // Hapus file fisik jika tipenya upload
    if($d['tipe_sumber'] == 'upload' && file_exists("../../../assets/img/".$d['sumber'])){
        unlink("../../../assets/img/".$d['sumber']);
    }
    
    if(mysqli_query($conn, "DELETE FROM galeri WHERE id='$id'")){
        header("location:index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>