<?php
session_start();
include '../connect.php';

// Ambil albumid dari URL
$komentarid = $_GET['komentarid'];

// Periksa apakah albumid telah diberikan
if(empty($komentarid)) {
    echo "Komentar ID tidak diberikan.";
    exit;
}
$sql = mysqli_query($c, "DELETE FROM komentarfoto WHERE komentarid='$komentarid'");
if ($sql) {
    // Jika penghapusan berhasil, arahkan pengguna kembali ke halaman album atau halaman lain yang sesuai
    echo "<script>
            alert('Album berhasil dihapus!');
            location.href = '../../users/dashboard.php';
          </script>";
} else {
    // Jika terjadi kesalahan saat menghapus album, tampilkan pesan kesalahan
    echo "Error: " . mysqli_error($c);
}

// Tutup koneksi ke database
mysqli_close($c);
?>