<?php
session_start();
include '../connect.php';

if(isset($_POST['regist'])) {
    // Mengambil dan membersihkan data yang dikirimkan melalui formulir
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $namalengkap=$_POST['namalengkap'];
    $alamat=$_POST['alamat'];
    
    // Mengambil informasi file foto yang diunggah
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $lokasi = '../../assets/profile/';
    $namafoto = uniqid() . '-' . $foto; // Menggunakan uniqid() untuk menghindari kemungkinan nama file yang sama
    
    // Memindahkan file foto ke lokasi yang diinginkan
    if(move_uploaded_file($tmp, $lokasi.$namafoto)) {
        // Query untuk menyimpan informasi foto ke dalam database
        $sql = "INSERT INTO user (username, password, email, namalengkap, alamat, foto) VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat', '$namafoto')";
        
        if(mysqli_query($c, $sql)) {
            // Jika query berhasil dijalankan
            echo "
                <script>
                alert('Registrasi Berhasil');
                window.location.href = '../../login.php';
                </script>
            ";
        } else {
            // Jika query gagal
            echo "
                <script>
                alert('Gagal melakukan Registrasi. Silakan coba lagi!');
                window.location.href = '../../register.php';
                </script>
            ";
        }
    } else {
        // Jika gagal memindahkan file foto
        echo "
            <script>
            alert('Gagal mengunggah file foto. Silakan coba lagi!');
            window.location.href = '../../register.php';
            </script>
        ";
    }
} else {
    // Jika tidak ada data yang dikirimkan melalui 'tambah2'
    echo "
        <script>
        alert('Akses tidak sah!');
        window.location.href = '../../register.php';
        </script>
    ";
}

?>