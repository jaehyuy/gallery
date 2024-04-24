<?php
    require 'config/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Page - Gallery</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
        @font-face {
            font-family: 'FindCartoon';
            src: url('assets/fonts/FindCartoon.ttf') format('truetype'); /* Format TTF */
            font-weight: normal;
            font-style: normal;
        }

        /* Gaya untuk membuat card transparan */
        .transparent-card {
            background-color: rgba(109, 161, 216, 0.5);
            border-radius: 15px; /* Mengatur sudut card menjadi bulat */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Efek bayangan lembut */
            padding: 20px; /* Padding dalam card */
            color:  #2B2B2B; 
            font-weight: bold;
        }
        body {
            background-image: url('assets/landing/back.svg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'FindCartoon', sans-serif;
            /* Opsi lainnya: Anda dapat menyesuaikan properti sesuai kebutuhan */
        }
        .form-control {
            width: 375px; /* Lebar input */
            height: 40px; /* Tinggi input */
            padding: 8px; /* Padding dalam input */
            font-size: 16px; /* Ukuran font dalam input */
            border: 2px solid #2c2324; /* Garis tepi input */
            border-radius: 20px; /* Sudut border radius */
            box-sizing: border-box; /* Memastikan lebar dan tinggi input termasuk border dan padding */
        }
        .label-font {
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
        .link-reg {
            color: #2B2B2B;
        }
        .link-reg:hover {
            color: #fff;
        }
        .header-image {
            display: block;
            margin: 0 auto; /* Mengatur gambar ke tengah secara horizontal */
            max-width: 100%; /* Membatasi lebar maksimal gambar */
            height: auto; /* Mengatur tinggi gambar sesuai proporsi */
        }
    </style>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card transparent-card mt-5" > 
                                    <div class="card-header bg-transparent text-center">
                                        <img src="assets/landing/log.png" alt="Login" class="header-image">
                                    </div>
                                    <div class="card-body text-center">
                                        <form action="config/relog/logins.php" method="post">
                                            <div class="form-group">
                                                <label for="inputUsername" class="label-font">Username</label>
                                                <input type="text" class="form-control text-center" id="inputUsername" name="username" placeholder="Enter your username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword" class="label-font">Password</label>
                                                <input type="password" class="form-control text-center" id="inputPassword" name="password" placeholder="Enter your password" required>
                                            </div>
                                            <button type="submit" name="login" class="btn btn rounded-pill btn-block mt-5">Login</button>
                                        </form>
                                    </div>
                                    <div class="card-footer bg-transparent text-center">
                                        <small><a href="register.php" class="link-reg">Need an account? Sign up!</a></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
           
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
