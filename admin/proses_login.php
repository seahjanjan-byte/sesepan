<?php
session_start();
include '../config/config.php'; // Path ini sudah benar jika file di folder admin/

// Menangkap data dari form login
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Query untuk cek admin
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_assoc($query);
    $_SESSION['admin_id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['status']   = "login";
    
    // REVISI: Gunakan $base_url untuk redirect yang aman
    header("location:" . $base_url . "admin/index.php");
} else {
    // REVISI: Gunakan $base_url
    header("location:" . $base_url . "admin/login.php?pesan=gagal");
}
?>