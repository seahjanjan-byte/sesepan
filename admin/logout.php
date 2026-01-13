<?php
// Memulai session
session_start();

// Menghapus semua data session
session_destroy();

// Menampilkan pesan sukses dan mengalihkan ke halaman utama/login
echo "<script>
    alert('Anda telah berhasil keluar dari sistem.');
    window.location='../index.php';
</script>";
?>