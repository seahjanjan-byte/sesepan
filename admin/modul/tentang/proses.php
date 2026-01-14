<?php
include '../../../config/config.php';
include '../../cek_session.php';

if (isset($_POST['update'])) {
    // Mengambil ID dan Isi dari form
    $id  = mysqli_real_escape_string($conn, $_POST['id']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    
    // Melakukan update data berdasarkan ID
    $query = "UPDATE profil SET isi='$isi' WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        // PERUBAHAN DI SINI:
        // Diarahkan keluar dari folder 'tentang' menuju folder 'profil'
        header("location:../profil/index.php?status=success");
        exit();
    } else {
        // Jika ada error database
        echo "Error Database: " . mysqli_error($conn);
    }
} else {
    // Jika diakses tanpa submit form, kembalikan ke profil
    header("location:../profil/index.php");
}
?>