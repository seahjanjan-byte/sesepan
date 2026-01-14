<?php
include '../../../config/config.php';

if (isset($_POST['update'])) {
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    
    // Pastikan WHERE kategori='tentang' sesuai dengan yang ada di database
    $query = "UPDATE profil SET isi='$isi' WHERE kategori='tentang'";
    
    if (mysqli_query($conn, $query)) {
        // Cek apakah ada baris yang benar-benar terupdate
        if (mysqli_affected_rows($conn) > 0) {
            header("location:index.php?status=success");
        } else {
            // Jika sukses tapi 0 baris berubah (biasanya karena teksnya sama persis)
            header("location:index.php?status=nochange");
        }
        exit();
    } else {
        echo "Error Database: " . mysqli_error($conn);
    }
} else {
    header("location:index.php");
}
?>