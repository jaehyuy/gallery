<?php
    session_start();
    include '../connect.php';
    if($_SESSION['status'] != 'login') {
        echo "
        <script>
        alert('Tidak dapat masuk aplikasi, silahkan login terlebih dahulu!');
        location.href='../../index.php';
        </script>
        ";
    }
    $userid = $_SESSION['userid'];
    $sql=mysqli_query($c,"SELECT * FROM user WHERE userid='$userid'");
            if(mysqli_num_rows($sql) == 0){
                echo '<script>window.location="profile.php"</script>';
            }
            while($d = mysqli_fetch_array($sql)){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Profile - Gallery</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
        @font-face {
            font-family: 'FindCartoon';
            src: url('../../assets/fonts/FindCartoon.ttf') format('truetype'); /* Format TTF */
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'ARCO';
            src: url('../../assets/fonts/ARCO.ttf') format('truetype'); /* Format TTF */
            font-weight: normal;
            font-style: normal;
        }
        body {
            background-image: url('../../assets/landing/blues.svg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'FindCartoon', sans-serif;
            /* Opsi lainnya: Anda dapat menyesuaikan properti sesuai kebutuhan */
        }
        .card-header {
            background-color: rgba(109, 161, 216, 0.5);
            font-family: 'ARCO', sans-serif;
            font-size: 30px; 
            color: #2B2B2B;
        }
        .transparent-card {
            max-width: 400px;
            position: relative;
            background-color: rgba(109, 161, 216, 0.5);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            overflow: hidden;
        }
        .form-control {
            width: 100%; /* Lebar input */
            height: 40px; /* Tinggi input */
            padding: 8px; /* Padding dalam input */
            font-size: 16px; /* Ukuran font dalam input */
            border: 2px solid #2c2324; /* Garis tepi input */
            border-radius: 20px; /* Sudut border radius */
            box-sizing: border-box; /* Memastikan lebar dan tinggi input termasuk border dan padding */
        }
        .form-label {
            font-size: 20px;
        }
        .btn {
            padding: 5px 40px; /* Padding tombol untuk membuatnya lebih panjang */
            min-width: 150px;
            margin-left: 5px;
            background-color: #ffa6c8;
            border: 2px solid #2B2B2B;
            font-size: 22px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #ffa6c8; /* Warna latar belakang saat tombol dihover */
            border-color: #2B2B2B; /* Warna border saat tombol dihover */
        }
        </style>
    </head>
    <body class="">
        <div class="container mt-5 justify-content-center" id="layoutSidenav">
            <div class="row">
                <div class="">
                    <div class="card transparent-card">
                        <div class="card-header text-center">
                            Edit profile
                        </div>
                        <div class="card-body text-center">
                            <form action="proses.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="userid" value="<?php echo $d['userid'] ?>">
                                <div class="form-group mt-2">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" value="<?php echo $d['username'] ?>" class="form-control text-center">
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Password</label>
                                    <input type="text" name="password" value="<?php echo $d['password']?>" class="form-control text-center">
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" value="<?php echo $d['email']?>" class="form-control text-center">
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="namalengkap" value="<?php echo $d['namalengkap']?>" class="form-control text-center">
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" name="alamat" value="<?php echo $d['alamat']?>" class="form-control text-center">
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Foto Profile</label> <br>
                                    <img src="../../assets/profile/<?php echo $d['foto'] ?>" width="150">
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label"> Ganti File</label>
                                    <input type="file" name="foto" class="form-control" value="<?php echo $d['foto'] ?>">
                                </div>
                                <button type="submit" class="btn rounded-pill mt-3" name="edit1">
                                    Save Changes
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>

    </body>
</html>
