<?php
include '../../../config/config.php';
include '../../cek_session.php';
include '../../upload_helper.php';
include '../../database_helper.php';

if (isset($_POST['update'])) {
    $admin_id = $_SESSION['admin_id'] ?? '';
    $isi      = $_POST['isi'] ?? '';
    $gambar   = $_FILES['gambar']['name'] ?? '';
    $tmp      = $_FILES['gambar']['tmp_name'] ?? '';
    $path     = "../../../assets/img/";

    if (!empty($gambar)) {
        $nama_file = store_uploaded_image($_FILES['gambar'], $path);
        if ($nama_file === false) {
            header("Location: ../profil/index.php?pesan=upload_gagal");
            exit();
        }

        // 1. Cari dan hapus bagan lama jika bukan default dan merupakan file valid
        $old = db_fetch_one($conn, "SELECT gambar FROM profil WHERE kategori = ?", 's', ['struktur']);
        remove_uploaded_file($path, $old['gambar'] ?? null);

        // 2. Upload bagan baru
        $success = db_execute($conn, "UPDATE profil SET isi = ?, gambar = ?, id_admin = ? WHERE kategori = ?", 'ssis', [$isi, $nama_file, $admin_id, 'struktur']);
    } else {
        $success = db_execute($conn, "UPDATE profil SET isi = ?, id_admin = ? WHERE kategori = ?", 'sis', [$isi, $admin_id, 'struktur']);
    }

    // Diarahkan keluar ke halaman utama profil
    header("Location: ../profil/index.php?status=success");
    exit();
} else {
    // Jika diakses tanpa submit, kembalikan ke profil
    header("Location: ../profil/index.php");
    exit();
}
