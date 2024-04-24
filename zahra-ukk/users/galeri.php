<?php
    session_start();
    $userid = $_SESSION['userid'];
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
        <title>Home Page - Gallery</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        }
        .navbar .nav-link {
            padding: 7px 50px; /* Padding tombol untuk membuatnya lebih panjang */
            min-width: 125px;
            margin-left: 5px;
            background-color: #ffa6c8;
            border: 3px solid #2B2B2B;
            font-size: 25px; 
            color: #2B2B2B;
        }
        .navbar .nav-link:hover {
            background-color: #ffa6c8; /* Warna latar belakang saat tombol dihover */
            border-color: #2B2B2B; /* Warna border saat tombol dihover */
        }
        .navbar-profile {
            margin-right: 10px;
        }
        .trans-card {
            margin-top: 130px;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%; /* Mengatur lebar card agar mengikuti lebar maksimal container */
            display: grid;
            place-items: center; /* Pusatkan konten secara horizontal dan vertikal */

        }
        .greeting {
            margin-bottom: 2px; /* Sesuaikan nilai sesuai kebutuhan */
        }
        .welcome-message {
            margin-top: 2px; /* Sesuaikan nilai sesuai kebutuhan */
        }
        .transparent-card {
            margin-bottom: 20px;
            position: relative;
            background-color: rgba(109, 161, 216, 0.5);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            overflow: hidden;
        }
        .trasnparent-card img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Agar gambar sesuai dengan ukuran container */
            border-radius: inherit; /* Menggunakan border radius yang sama dengan card */

            /* Optional: Menambahkan efek hover untuk gambar */
            transition: transform 0.2s ease;
        }

        .transparent-card:hover img {
            transform: scale(1.05); /* Contoh efek zoom saat hover */
        }
        .card-alb {
            background-color: #ffa6c8;
            border: 2px solid #2B2B2B;
            color: #2B2B2B;
            border-radius: 50px;
        }
        .img-card {
            padding-top: 8px;
        }
        footer {
            background-color:  rgba(109, 161, 216, 0.5);
            border-top: 2px solid #2B2B2B;
        }
        .img-container img {
            width: 73px;
            height: 73px;
            border: 3px solid #2b2b2b; /* Warna dan ketebalan border */
            border-radius: 50%; /* Membuat border berbentuk lingkaran dengan radius 50% */
        }

        </style>
    </head>
    <body>
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

        <div class="container trans-card">
            <div class="row">
                <?php
                    $album = mysqli_query($c, "SELECT * FROM album WHERE userid='$userid'");
                    while($row = mysqli_fetch_array($album)){ ?>
                    <div class="col-2">
                        <a href="galeri.php?albumid=<?php echo $row['albumid'] ?>" class="text-decoration-none">
                            <div class="card-alb text-center">
                                <img src="../assets/landing/al.svg" alt="Album" width="90%" class="img-card" />
                                <div class="card-footer bg-transparent">
                                    <p><?php echo $row['namaalbum'] ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php  } ?>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <?php
                if(isset($_GET['albumid'])){
                    $albumid = $_GET['albumid'];
                    $query = mysqli_query($c, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid' ");
                    while($d = mysqli_fetch_array($query)){ ?>
                <div class="col-md-3">
                    <div class="card transparent-card text-center">
                        <img src="../assets/img/<?php echo $d['lokasifile'] ?>" class="card-img-top" title="<?php echo $d['judulfoto'] ?>" style=" height: 12rem;">
                        <div class="card-footer bg-transparent">
                            <h4><?php echo $d['judulfoto'] ?></h4>
                            <p><?php echo $d['deskripsifoto']  ?></p>
                        </div>
                    </div>
                </div>
                <?php }
                }else{
                    $query = mysqli_query($c, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid WHERE user.userid='$userid'");
                    while($d = mysqli_fetch_array($query)){ ?>
                <div class="col-md-3">
                    <div class="card transparent-card text-center">
                        <img src="../assets/img/<?php echo $d['lokasifile'] ?>" class="card-img-top" title="<?php echo $d['judulfoto'] ?>" style=" height: 12rem;">
                        <div class="card-footer bg-transparent">
                            <h4><?php echo $d['judulfoto'] ?></h4>
                            <p><?php echo $d['deskripsifoto']  ?></p>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>

        <footer class="text-center mt-5">
            <div class="mx-auto py-2 my-2">
                <p>&copy; 2024 Ukk Gallery, Zahra Salsabila.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>