<?php
session_start();
include '../connect.php';

if(isset($_POST['tambah1'])) {
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tgldibuat = date('Y-m-d');
    $userid = $_SESSION['userid'];

    $sql = mysqli_query($c, "INSERT INTO album VALUES ('','$namaalbum','$deskripsi','$tgldibuat','$userid')");
    echo "
        <script>
        alert('Album Berhasil Ditambahkan!');
        location.href='../../users/album.php';
        </script>
        ";
}
?>