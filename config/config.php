<?php
// 1. Konfigurasi Database
// SAAT DI HOSTING: Ganti 'localhost', 'root', '', dan 'sdn_Dukuhbenda 02' sesuai data dari cPanel/Hosting Anda.
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sdn-dukuhbenda02";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// 2. Pengaturan Waktu (WIB)
date_default_timezone_set('Asia/Jakarta');

// 3. Logika Base URL Otomatis
// Kode ini akan mendeteksi secara otomatis apakah website menggunakan http atau https
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host_url = $_SERVER['HTTP_HOST'];

$project_folder = "/sdn-dukuhbenda02/";

$base_url = $protocol . $host_url . $project_folder;
