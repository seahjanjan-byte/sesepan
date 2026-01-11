<?php
// Konfigurasi Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sdn_sesepan";

// Membuat Koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek Koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set timezone agar waktu posting berita sesuai (WIB)
date_default_timezone_set('Asia/Jakarta');

// Base URL (opsional, memudahkan pemanggilan asset agar tidak pecah saat pindah folder)
$base_url = "http://localhost/sdn-sesepan/";
?>