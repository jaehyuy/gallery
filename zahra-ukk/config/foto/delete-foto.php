<?php
session_start();
include '../connect.php';

// Ambil fotoid dari URL
$fotoid = $_GET['fotoid'];

// Periksa apakah fotoid telah diberikan
if(empty($fotoid)) {
    echo "Fotoid tidak diberikan.";
    exit;
}

// Hapus semua like terkait dengan foto
$sql_delete_likes = mysqli_query($c, "DELETE FROM likefoto WHERE fotoid='$fotoid'");
if (!$sql_delete_likes) {
    // Jika terjadi kesalahan saat menghapus like, tampilkan pesan kesalahan
    echo "Error: " . mysqli_error($c);
    exit;
}

// Hapus semua komentar foto terkait dengan foto
$sql_delete_comments = mysqli_query($c, "DELETE FROM komentarfoto WHERE fotoid='$fotoid'");
if (!$sql_delete_comments) {
    // Jika terjadi kesalahan saat menghapus komentar foto, tampilkan pesan kesalahan
    echo "Error: " . mysqli_error($c);
    exit;
}

// Setelah semua like dan komentar foto dihapus, hapus foto
$sql_delete_foto = mysqli_query($c, "DELETE FROM foto WHERE fotoid='$fotoid'");
if ($sql_delete_foto) {
    // Jika penghapusan berhasil, arahkan pengguna kembali ke halaman foto atau halaman lain yang sesuai
    echo "<script>
            alert('Foto berhasil dihapus!');
            window.location.href = '../../users/foto.php';
          </script>";
} else {
    // Jika terjadi kesalahan saat menghapus foto, tampilkan pesan kesalahan
    echo "Error: " . mysqli_error($c);
}

// Tutup koneksi ke database
mysqli_close($c);
?>