<?php
    session_start();
    include '../config/connect.php';
    if($_SESSION['status'] != 'login') {
        echo "
        <script>
        alert('Tidak dapat masuk aplikasi, silahkan login terlebih dahulu!');
        location.href='../index.php';
        </script>
        ";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Data Album - Gallery</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
        @font-face {
            font-family: 'FindCartoon';
            src: url('../assets/fonts/FindCartoon.ttf') format('truetype'); /* Format TTF */
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'ARCO';
            src: url('../assets/fonts/ARCO.ttf') format('truetype'); /* Format TTF */
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Ginchiest';
            src: url('../assets/fonts/Ginchiest.ttf') format('truetype'); /* Format TTF */
            font-weight: normal;
            font-style: normal;
        }
        .navbar-brand {
            font-family: 'Ginchiest', sans-serif;
            font-size: 3.5rem;
            color: #ffa6c8;
            text-shadow: 
            -1px -1px 0 #2b2b2b,  
            1px -1px 0 #2b2b2b,
            -1px 1px 0 #2b2b2b,
            1px 1px 0 #2b2b2b, /* Efek garis pinggir (stroke) */
            2px 4px 0 #2b2b2b; /* Efek bayangan */
        }
        .navbar-brand:hover {
            color: #ffa6c8;
            text-shadow: 
            -1px -1px 0 #2b2b2b,  
            1px -1px 0 #2b2b2b,
            -1px 1px 0 #2b2b2b,
            1px 1px 0 #2b2b2b, /* Efek garis pinggir (stroke) */
            2px 4px 0 #2b2b2b; /* Efek bayangan */
        }
        body {
            background-image: url('../assets/landing/blues.svg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'FindCartoon', sans-serif;
            /* Opsi lainnya: Anda dapat menyesuaikan properti sesuai kebutuhan */
        }
        .navbar {
            background-color: rgba(109, 161, 216, 0.5);
            border-bottom: 2px solid #2b2b2b;
            padding: 15px;
        }
        .navbar .nav-link {
            padding: 5px 40px; /* Padding tombol untuk membuatnya lebih panjang */
            min-width: 115px;
            margin-left: 5px;
            background-color: #ffa6c8;
            border: 3px solid #2B2B2B;
            font-size: 22px; 
            font-weight: bold; 
            color: #2B2B2B;
        }
        .navbar .nav-link:hover {
            background-color: #ffa6c8; /* Warna latar belakang saat tombol dihover */
            border-color: #2B2B2B; /* Warna border saat tombol dihover */
        }
        .navbar-profile {
            margin-right: 10px;
        }
        .con {
            margin-top: 100px;
        }
        .greeting {
            margin-bottom: 2px; /* Sesuaikan nilai sesuai kebutuhan */
        }
        .welcome-message {
            margin-top: 2px; /* Sesuaikan nilai sesuai kebutuhan */
        }
        .transparent-card {
            position: relative;
            background-color: rgba(109, 161, 216, 0.5);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            overflow: hidden;
        }
        .col-md-4 {
            padding: 20px;
            width: 100%;
        }
        .col-md-8 {
            padding: 20px;
            width: 100%;
        }
        .row {
            padding: 25px;
        }
        .form-control {
            width: 250px; /* Lebar input */
            height: 40px; /* Tinggi input */
            padding: 4px; /* Padding dalam input */
            font-size: 14px; /* Ukuran font dalam input */
            border: 2px solid #2b2b2b; /* Garis tepi input */
            border-radius: 20px; /* Sudut border radius */
            box-sizing: border-box; /* Memastikan lebar dan tinggi input termasuk border dan padding */
        }
        .label-font {
            font-size: 20px;
        }
        .btn-submit {
            width: 250px; /* Lebar input */
            height: 40px; /* Tinggi input */
            padding: 4px; /* Padding dalam input */
            background-color: #ffa6c8;
            border: 2px solid #2B2B2B;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn-submit:hover {
            background-color: #ffa6c8; /* Warna latar belakang saat tombol dihover */
            border-color: #2B2B2B; /* Warna border saat tombol dihover */
        }
        .table {
            color: #2b2b2b;
            background-color: #ffa6c8;
            border: 2px solid #2B2B2B;
        }
        .card-header {
            background-color: rgba(109, 161, 216, 0.5);
            font-family: 'ARCO', sans-serif;
            font-size: 30px; 
            color: #2B2B2B;
            
        }
        tbody {
            background-color: #fff;
            font-size: 16px;
        }
        .img-container img {
            width: 73px;
            height: 73px;
            border: 3px solid #2b2b2b; /* Warna dan ketebalan border */
            border-radius: 50%; /* Membuat border berbentuk lingkaran dengan radius 50% */
        }


        </style>
    </head>
    <body class="">
        <header class="p-3">
            <nav class="navbar navbar-expand-lg fixed-top bg">
                <div class="container">
                    <?php 
                    $userid = $_SESSION['userid'];
                    $sql=mysqli_query($c,"SELECT * FROM user WHERE userid='$userid'");
                            if(mysqli_num_rows($sql) == 0){
                                echo '<script>window.location="profile.php"</script>';
                            }
                            while($d = mysqli_fetch_array($sql)){
                    ?>
                    <div class="img-container">
                        <a class="navbar-profile text-decoration-none" href="../config/profiles/edit-profile.php" title="Profile">
                            <img src="../assets/profile/<?php echo $d['foto'] ?>" width="70" height="70" class="rounded-circle me-2"/>
                        </a>
                    </div>
                    <?php }?>
                    <a class="navbar-brand" href="dashboard.php" title="Dashboard">
                        Gallery
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link btn btn rounded-pill"href="galeri.php">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn rounded-pill" href="album.php">ALBUM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn rounded-pill" href="foto.php">FOTO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn rounded-pill" href="../config/relog/logout.php">LOGOUT</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        
        <div class="container con justify-content-center" id="layoutSidenav">
            <div class="row">
                <div class="col-md-4">
                    <div class="card transparent-card" > 
                        <div class="card-header text-center">
                            add album
                        </div>
                        <div class="card-body text-center">
                            <form action="../config/album/tambah-album.php" method="post">
                                <div class="form-group">
                                    <label class="label-font">Nama Album</label>
                                    <input type="text" class="form-control text-center" name="namaalbum" placeholder="Enter your album name" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="label-font">Deskripsi</label>
                                    <input type="text" class="form-control text-center" name="deskripsi" placeholder="Enter your deskripsi" required>
                                </div>
                                <button type="submit" name="tambah1" class="btn btn rounded-pill btn-submit mt-3">Add Album</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card transparent-card" >
                        <div class="card-header text-center">
                            daftar album
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Album</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi Album</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        $userid = $_SESSION['userid'];
                                        $sql = mysqli_query($c, "SELECT * FROM album WHERE userid='$userid'");
                                        while($d = mysqli_fetch_array($sql)){
                                    ?>
                                    <tr>
                                        <td><?=$no++;?></td>
                                        <td><?php echo $d['namaalbum'] ?></td>
                                        <td><?php echo $d['deskripsi'] ?></td>
                                        <td><?php echo $d['tgldibuat'] ?></td>
                                        <td>
                                            <a href="../config/album/edit-album.php?albumid=<?php echo $d['albumid'] ?>" title="Edit Album" class="text-decoration-none">
                                                <img src="../assets/landing/editt.svg" width="30px" height="30px"/>
                                            </a>
                                            <a href="../config/album/delete-album.php?albumid=<?php echo $d['albumid']?>" title="Delete Album" class="text-decoration-none">
                                                <img src="../assets/landing/trash.svg" width="30px" height="30px"/>
                                            </a> 
                                        </td>
                                    </tr>
                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
