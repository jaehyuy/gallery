<?php
    session_start();
    include 'config/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Landing Page - Gallery</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            @font-face {
            font-family: 'FindCartoon';
            src: url('assets/fonts/FindCartoon.ttf') format('truetype'); /* Format TTF */
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Ginchiest';
            src: url('assets/fonts/Ginchiest.ttf') format('truetype'); /* Format TTF */
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
            background-image: url('assets/landing/blues.svg');
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
        .con {
            margin-top: 130px;
        }
        .transparent-card {
            margin-bottom: 15px;
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
        </style>
    </head>
    <body>
        <header class="p-3">
            <nav class="navbar navbar-expand-lg fixed-top bg">
                <div class="container">
                    <a class="navbar-brand" href="index.php" title="Gallery?">
                        Gallery
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link btn btn rounded-pill" href="login.php">LOGIN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn rounded-pill" href="register.php">REGISTER</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container con">
            <div class="row">
                <?php
                if(isset($_GET['fotoid'])){
                    $query = mysqli_query($c, "SELECT * FROM foto ");
                    while($d = mysqli_fetch_array($query)){ ?>

                    <div class="col-md-3 mt-2">
                    <div class="card transparent-card">
                        <img src="../assets/img/<?php echo $d['lokasifile'] ?>" class="card-img-top" title="<?php echo $d['judulfoto'] ?>" style=" height: 12rem;">
                        <div class="card-footer text-center bg-transparent">

                            <?php
                            $fotoid = $d['fotoid'];
                            $liked = mysqli_query($c, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                            if(mysqli_num_rows($liked) > 0){ ?>
                                <a href="../config/like.php?fotoid=<?php echo $d['fotoid'] ?>" type="submit" name="Cliked"><i class="fa-solid fa-heart" style="color: #ff7381;"></i></a>
                            <?php }else{ ?>
                                <a href="../config/like.php?fotoid=<?php echo $d['fotoid'] ?>" type="submit" name="liked"><i class="fa-regular fa-heart"></i></a>

                            <?php } 
                            $like = mysqli_query($c, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($like). ' Suka';
                            ?>

                            
                            <a href=""><i class="fa-regular fa-comment"></i></a>
                        </div>
                    </div>
                </div>

                    <?php }
                }else{

        $query = mysqli_query($c, "SELECT * FROM foto INNER JOIN album ON foto.albumid=album.albumid ");
        while($d = mysqli_fetch_array($query)){

        
        ?>
                <div class="col-md-3 mt-2">
                    <div class="card transparent-card">
                        <img src="assets/img/<?php echo $d['lokasifile'] ?>" class="card-img-top" title="<?php echo $d['judulfoto'] ?>" style=" height: 12rem;">
                            <div class="card-footer text-center bg-transparent">
                                <h3><?php echo $d['judulfoto'] ?></h3>

                                <a href="config/warns.php"><i class="fa-regular fa-heart"></i></a>
                                <?php
                                $fotoid = $d['fotoid'];

                                $like = mysqli_query($c, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like). ' Suka';
                                ?>

                            
                                <a href="config/warns.php"><i class="fa-regular fa-comment"></i></a>
                                <?php $koms = mysqli_query($c, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($koms).' Komentar';
                                
                                ?>
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

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
