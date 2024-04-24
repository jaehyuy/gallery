<?php
    include "../connect.php";
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $sql = mysqli_query($c,"SELECT * FROM user WHERE username='$username' AND password='$password'");

    $cek = mysqli_num_rows($sql);

    if($cek > 0) {
        $d = mysqli_fetch_array($sql);

        $_SESSION['username'] = $d['username'];
        $_SESSION['userid'] = $d['userid'];
        $_SESSION['status'] = 'login';
        echo "
        <script>
        alert('Berhasil Login!');
        location.href='../../users/dashboard.php';
        </script>
        ";
    } else{
        echo "
        <script>
        alert('Username atau Password salah!');
        location.href='../../dashboard.php';
        </script>
        ";
    }

?>