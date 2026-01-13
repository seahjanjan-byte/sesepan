<?php
include '../../../config/config.php';

if(isset($_POST['update'])){
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    
    // Update data berdasarkan kategori sejarah
    $sql = "UPDATE profil SET isi='$isi' WHERE kategori='sejarah'";
    
    if(mysqli_query($conn, $sql)){
        // Alihkan kembali ke halaman utama pengaturan profil
        header("location:../profil/index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Jika diakses tanpa submit, kembalikan ke index
    header("location:index.php");
}
?>