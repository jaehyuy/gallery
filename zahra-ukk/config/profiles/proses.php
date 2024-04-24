<?php
    session_start();
    include '../connect.php';

    // Pastikan pengguna sudah login sebelum mengubah profil
    if($_SESSION['status'] != 'login') {
        echo "
        <script>
        alert('Tidak dapat mengakses aplikasi, silakan login terlebih dahulu!');
        location.href='../../index.php';
        </script>
        ";
        exit; // Hentikan eksekusi script jika pengguna belum login
    }

    // Tangkap data yang dikirimkan melalui form
    $userid = $_SESSION['userid']; // Ambil userid dari session
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];

    if ($_FILES['foto']['name'] != "") {
        $rand = rand();
        $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
        $filename = $_FILES['foto']['name'];
        $ukuran = $_FILES['foto']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($ext, $ekstensi)) {
            echo '<script>alert("Ekstensi file tidak valid.");window.location="../../users/dashboard.php";</script>';
            exit;
        } else {
            // Validasi ukuran file
            if ($ukuran < 1044070) {
                $newFilename = $rand . '-' . $filename;
                move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/profile/' . $newFilename);

                // Update data foto dengan file baru
                $updateQuery = "UPDATE user SET username='$username', password='$password', email='$email', namalengkap='$namalengkap', alamat='$alamat' , foto='$newFilename' WHERE userid=$userid";
                mysqli_query($c, $updateQuery);

                echo '<script>alert("Profile berhasil diupdate.");window.location="../../users/dashboard.php";</script>';
                exit;
            } else {
                echo '<script>alert("Ukuran file terlalu besar.");window.location="../../users/dashboard.php";</script>';
                exit;
            }
        }
    } else {
        // Update data foto tanpa mengganti file
        $updateQuery = "UPDATE user SET username='$username', password='$password', email='$email', namalengkap='$namalengkap', alamat='$alamat' WHERE userid=$userid";
        mysqli_query($c, $updateQuery);

        echo '<script>alert("Profile berhasil diupdate.");window.location="../../users/dashboard.php";</script>';
        exit;
    }
?>