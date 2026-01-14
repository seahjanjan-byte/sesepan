<?php
session_start();
include '../config/config.php';
include 'cek_session.php'; // Sesuaikan pathnya jika berada di dalam folder modul 

// Menangkap data dari form login
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Query untuk cek admin (Sesuaikan nama tabel Anda, misal: 'admin' atau 'user')
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_assoc($query);
    $_SESSION['admin_id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['status']   = "login";
    
    // Alihkan ke halaman dashboard admin
    header("location:index.php");
} else {
    // Jika gagal, kembali ke login dengan pesan error
    header("location:login.php?pesan=gagal");
}
?>