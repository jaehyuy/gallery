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
        <title>Dashboard - Gallery</title>
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
        .trans-card {
            margin-top: 130px;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            border-radius: 10px;
            padding: 20px;
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
        .modal-content {
            background-color: rgba(255, 255, 255, 0.8);
        }
        .badge{
            background-color: #ffa6c8;
            margin-top: 10px;
            border: 2px solid #2B2B2B;
            padding: 5px 10px; /* Padding tombol untuk membuatnya lebih panjang */
            min-width: 50px;
            border-radius: 50px;
            color: #2b2b2b;
        }
        .btn {
            background-color: #ffa6c8;
        }
        .btn:hover {
            background-color: #ffa6c8;
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
        <div class="container">
            <div class="row">
                <div class="card-body text-center trans-card">
                    <h1 style='font-weight: bold; font-size: 60px; ' class="greeting">Hi <?php 
                        $userid = $_SESSION['userid'];
                        $sql = mysqli_query($c, "SELECT * FROM user WHERE userid='$userid'");
                        while($d = mysqli_fetch_array($sql)){
                            echo $d['namalengkap'];
                        }
                        ?>!
                    </h1>
                    <p class="welcome-message"><h4>Selamat Datang di Website Gallery Photo</h4></p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <?php
                    if(isset($_GET['fotoid'])){
                        $query = mysqli_query($c, "SELECT * FROM foto ");
                        while($d = mysqli_fetch_array($query)){ ?>
                <div class="col-md-3">
                    <div class="card transparent-card text-center">
                        <img src="../assets/img/<?php echo $d['lokasifile'] ?>" class="card-img-top" title="<?php echo $d['judulfoto'] ?>" style=" height: 12rem;">
                        <div class="card-footer bg-transparent">
                            <?php
                                $fotoid = $d['fotoid'];
                                $liked = mysqli_query($c, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                                if(mysqli_num_rows($liked) > 0){ ?>
                                    <a href="../config/licom/like.php?fotoid=<?php echo $d['fotoid'] ?>" type="submit" name="Cliked"><i class="fas fa-heart" style="color: #E60035;"></i></a>
                                <?php }else{ ?>
                                    <a href="../config/licom/like.php?fotoid=<?php echo $d['fotoid'] ?>" type="submit" name="liked"><i class="far fa-heart" style="font-weight: bold;"></i></a>

                                <?php } 
                                $like = mysqli_query($c, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like). ' Suka';
                                ?>
                            
                            <a href=""><i class="fa-regular fa-comment" style="font-weight: bold;"></i></a>
                        </div>
                    </div>
                </div>
                <?php }
                }else{
                    $query = mysqli_query($c, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid ");
                    while($d = mysqli_fetch_array($query)){ ?>

                <div class="col-md-3">
                    <div class="card transparent-card text-center">
                        <img src="../assets/img/<?php echo $d['lokasifile'] ?>" class="card-img-top" title="<?php echo $d['judulfoto'] ?>" style=" height: 12rem;">
                        <div class="card-footer bg-transparent">
                            <?php
                                $fotoid = $d['fotoid'];
                                $liked = mysqli_query($c, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                                if(mysqli_num_rows($liked) > 0){ ?>
                                    <a href="../config/licom/like.php?fotoid=<?php echo $d['fotoid'] ?>" type="submit" name="Cliked"><i class="fas fa-heart" style="color: #E60035;" ></i></a>
                                <?php }else{ ?>
                                    <a href="../config/licom/like.php?fotoid=<?php echo $d['fotoid'] ?>" type="submit" name="liked"><i class="far fa-heart" style="font-weight: bold;"></i></a>

                                <?php } 
                                $like = mysqli_query($c, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like). ' Suka';
                                ?>
                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#comment<?php echo $d['fotoid'] ?>"><i class="fa-regular fa-comment" style="font-weight: bold;"></i></a>
                                <?php $koms = mysqli_query($c, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($koms).' Komentar';
                                
                            ?>
                        </div>
                    </div>
                    <div class="modal fade" id="comment<?php echo $d['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img src="../assets/img/<?php echo $d['lokasifile'] ?>" class="card-img-top modal-image" title="<?php echo $d['judulfoto'] ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-2">
                                                <div class="ms-auto">
                                                    <div class="sticky-top">
                                                        <strong style="font-size: 20px;">
                                                        <?php echo $d['judulfoto'] ?>
                                                    </strong> <br>
                                                    <span class="badge">
                                                        <?php echo $d['namalengkap'] ?>
                                                    </span>
                                                    <span class="badge">
                                                        <?php echo $d['tglunggah'] ?>
                                                    </span>
                                                    <span class="badge">
                                                        <?php echo $d['namaalbum'] ?>
                                                    </span>
                                                </div>
                                                <hr>
                                                <p align='left'>
                                                    <?php echo $d['deskripsifoto'] ?>
                                                </p>
                                                <hr>
                                                
                                                <?php 
                                                $fotoid = $d['fotoid'];
                                                $komen = mysqli_query($c, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                                                while($row = mysqli_fetch_array($komen)) { ?>
                                                <div class="d-flex justify-content-between"> <!-- Menambahkan kelas justify-content-end untuk menjadikan tautan di pojok kanan -->
                                                <div>
                                                    <span style='font-weight: bold; '><?php echo $row['namalengkap'] ?></span>
                                                    <?php echo $row['isikomen'] ?>
                                                </div>
                                                <?php if ($row['userid'] == $_SESSION['userid']) { ?>
                                                    <!-- Tautan untuk edit dan hapus komentar -->
                                                    <div>
                                                        <a href="../config/licom/edit-comment.php?komentarid=<?php echo $row['komentarid'] ?>&fotoid=<?php echo $d['fotoid']; ?>" class="text-decoration-none">
                                                            <img src="../assets/landing/editt.svg" width="30px" height="30px"/>
                                                        </a>
                                                        <a href="../config/licom/delete-comment.php?komentarid=<?php echo $row['komentarid'] ?>" class="text-decoration-none">
                                                            <img src="../assets/landing/trash.svg" width="30px" height="30px"/>
                                                        </a>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <?php } ?>
                                                <hr>
                                                <div class="sticky-bottom">
                                                    <form action="../config/licom/comment.php" method="POST">
                                                        <div class="input-group rounded">
                                                            <input type="hidden" name="fotoid" value="<?php echo $d['fotoid'] ?>">
                                                            <input type="text" name="isikomen" class="form-control rounded-left" placeholder="Tambah Komentar" required>
                                                            <div class="input-group-prepend">
                                                                <button type=submit name="send" class="btn rounded-right">
                                                                    Send
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>