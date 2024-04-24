<?php
session_start();
include '../connect.php';

// Ambil albumid dari URL
$albumid = $_GET['albumid'];

// Periksa apakah albumid telah diberikan
if(empty($albumid)) {
    echo "Album ID tidak diberikan.";
    exit;
}

// Hapus semua komentar foto terkait dengan foto yang berada dalam album
$sql_delete_comments = mysqli_query($c, "DELETE komentarfoto FROM komentarfoto INNER JOIN foto ON komentarfoto.fotoid = foto.fotoid WHERE foto.albumid='$albumid'");
if (!$sql_delete_comments) {
    // Jika terjadi kesalahan saat menghapus komentar foto, tampilkan pesan kesalahan
    echo "Error: " . mysqli_error($c);
    exit;
}

// Hapus semua like terkait dengan foto yang berada dalam album
$sql_delete_likes = mysqli_query($c, "DELETE likefoto FROM likefoto INNER JOIN foto ON likefoto.fotoid = foto.fotoid WHERE foto.albumid='$albumid'");
if (!$sql_delete_likes) {
    // Jika terjadi kesalahan saat menghapus like, tampilkan pesan kesalahan
    echo "Error: " . mysqli_error($c);
    exit;
}

// Hapus semua foto yang berada dalam album
$sql_delete_foto = mysqli_query($c, "DELETE FROM foto WHERE albumid='$albumid'");
if (!$sql_delete_foto) {
    // Jika terjadi kesalahan saat menghapus foto, tampilkan pesan kesalahan
    echo "Error: " . mysqli_error($c);
    exit;
}

// Hapus album itu sendiri
$sql_delete_album = mysqli_query($c, "DELETE FROM album WHERE albumid='$albumid'");
if ($sql_delete_album) {
    // Jika penghapusan berhasil, arahkan pengguna kembali ke halaman album atau halaman lain yang sesuai
    echo "<script>
            alert('Album berhasil dihapus!');
            location.href = '../../users/album.php';
          </script>";
} else {
    // Jika terjadi kesalahan saat menghapus album, tampilkan pesan kesalahan
    echo "Error: " . mysqli_error($c);
}

// Tutup koneksi ke database
mysqli_close($c);
?>
