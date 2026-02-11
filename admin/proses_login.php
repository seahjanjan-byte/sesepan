<?php
session_start();
include '../config/config.php'; 

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Query disesuaikan dengan struktur tabel admin baru
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_assoc($query);
    // Menggunakan kolom 'id_admin' sesuai script SQL revisi
    $_SESSION['admin_id'] = $data['id_admin']; 
    $_SESSION['username'] = $data['username'];
    $_SESSION['status']   = "login";
    
    header("location:" . $base_url . "admin/index.php");
} else {
    header("location:" . $base_url . "admin/login.php?pesan=gagal");
}
?>