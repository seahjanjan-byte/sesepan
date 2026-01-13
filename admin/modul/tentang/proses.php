<?php
include '../../../config/config.php';

if(isset($_POST['update'])){
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    
    $query = "UPDATE profil SET isi='$isi' WHERE kategori='tentang'";
    
    if(mysqli_query($conn, $query)){
        header("location:index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>