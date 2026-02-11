<?php
include '../../../config/config.php';
include '../../cek_session.php';

if (isset($_POST['update'])) {
    $id_admin = $_SESSION['admin_id']; // Mengambil ID Admin pengelola sesuai aturan relasi
    $id_profil = mysqli_real_escape_string($conn, $_POST['id']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $file = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $path = "../../../assets/img/";

    // Cek apakah data sambutan sudah ada di database
    $cek_data = mysqli_query($conn, "SELECT id_profil, gambar FROM profil WHERE kategori='sambutan'");
    $ada = mysqli_num_rows($cek_data) > 0;
    $data_lama = mysqli_fetch_array($cek_data);

    $nama_file = $ada ? $data_lama['gambar'] : 'default.jpg';

    // Jika ada upload foto baru
    if (!empty($file)) {
        // Hapus foto lama jika bukan default
        if ($ada && !empty($data_lama['gambar']) && $data_lama['gambar'] != 'default.jpg' && file_exists($path . $data_lama['gambar'])) {
            unlink($path . $data_lama['gambar']);
        }

        // Upload foto baru
        $nama_file = "sambutan_" . time() . "_" . $file;
        move_uploaded_file($tmp, $path . $nama_file);
    }

    if ($ada) {
        // Logika UPDATE: Tetap menyertakan id_admin agar relasi terjaga
        $query = "UPDATE profil SET isi='$isi', gambar='$nama_file', id_admin='$id_admin' WHERE kategori='sambutan'";
    } else {
        // Logika INSERT: Gunakan ID String (Zero-Math Rule)
        $query = "INSERT INTO profil (id_profil, id_admin, kategori, judul, isi, gambar) 
                  VALUES ('PFL_SAMBUTAN', '$id_admin', 'sambutan', 'Sambutan Kepala Sekolah', '$isi', '$nama_file')";
    }

    if(mysqli_query($conn, $query)){
        header("location:index.php?status=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("location:index.php");
    exit();
}
?>