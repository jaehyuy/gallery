<?php
session_start();
include '../connect.php';

if(isset($_POST['tambah2'])) {
    // Mengambil dan membersihkan data yang dikirimkan melalui formulir
    $judulfoto = mysqli_real_escape_string($c, $_POST['judulfoto']);
    $deskripsifoto = mysqli_real_escape_string($c, $_POST['deskripsifoto']);
    $albumid = mysqli_real_escape_string($c, $_POST['albumid']);
    $userid = $_SESSION['userid'];
    $tglunggah = date('Y-m-d');
    
    // Mengambil informasi file foto yang diunggah
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../../assets/img/';
    $namafoto = uniqid() . '-' . $foto; // Menggunakan uniqid() untuk menghindari kemungkinan nama file yang sama
    
    // Memindahkan file foto ke lokasi yang diinginkan
    if(move_uploaded_file($tmp, $lokasi.$namafoto)) {
        // Query untuk menyimpan informasi foto ke dalam database
        $sql = "INSERT INTO foto (judulfoto, deskripsifoto, tglunggah, lokasifile, albumid, userid) VALUES ('$judulfoto', '$deskripsifoto', '$tglunggah', '$namafoto', '$albumid', '$userid')";
        
        if(mysqli_query($c, $sql)) {
            // Jika query berhasil dijalankan
            echo "
                <script>
                alert('Data Foto Berhasil Disimpan!');
                window.location.href = '../../users/foto.php';
                </script>
            ";
        } else {
            // Jika query gagal
            echo "
                <script>
                alert('Gagal menyimpan data foto. Silakan coba lagi!');
                window.location.href = '../../users/foto.php';
                </script>
            ";
        }
    } else {
        // Jika gagal memindahkan file foto
        echo "
            <script>
            alert('Gagal mengunggah file foto. Silakan coba lagi!');
            window.location.href = '';
            </script>
        ";
    }
} else {
    // Jika tidak ada data yang dikirimkan melalui 'tambah2'
    echo "
        <script>
        alert('Akses tidak sah!');
        window.location.href = '';
        </script>
    ";
}

?>