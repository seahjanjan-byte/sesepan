<?php
session_start();
include_once __DIR__ . '/../config/config.php'; // Ambil config agar base_url tersedia
include_once __DIR__ . '/../includes/csrf_helper.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    // Alihkan ke login menggunakan base_url agar pasti ketemu
    header("location:" . $base_url . "admin/login.php?pesan=belum_login");
    exit();
}
