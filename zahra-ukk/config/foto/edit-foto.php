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
    if (isset($_POST['edit2'])) {
        $judulfoto = $_POST['judulfoto'];
        $deskripsifoto = $_POST['deskripsifoto'];
        $albumid = $_POST['albumid'];
        $fotoid = $_GET['id']; // Ambil foto ID dari parameter URL
    
        // Jika ada file gambar yang diunggah
        if ($_FILES['lokasifile']['name'] != "") {
            $rand = rand();
            $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
            $filename = $_FILES['lokasifile']['name'];
            $ukuran = $_FILES['lokasifile']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
            // Validasi ekstensi file
            if (!in_array($ext, $ekstensi)) {
                echo '<script>alert("Ekstensi file tidak valid.");window.location="../../users/foto.php";</script>';
                exit;
            } else {
                // Validasi ukuran file
                if ($ukuran < 1044070) {
                    $newFilename = $rand . '-' . $filename;
                    move_uploaded_file($_FILES['lokasifile']['tmp_name'], '../../assets/img/' . $newFilename);
    
                    // Update data foto dengan file baru
                    $updateQuery = "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', lokasifile='$newFilename', albumid='$albumid' WHERE fotoid='$fotoid'";
                    mysqli_query($c, $updateQuery);
    
                    echo '<script>alert("Foto berhasil diupdate.");window.location="../../users/foto.php";</script>';
                    exit;
                } else {
                    echo '<script>alert("Ukuran file terlalu besar.");window.location="../../users/foto.php";</script>';
                    exit;
                }
            }
        } else {
            // Update data foto tanpa mengganti file
            $updateQuery = "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', albumid='$albumid' WHERE fotoid='$fotoid'";
            mysqli_query($c, $updateQuery);
    
            echo '<script>alert("Foto berhasil diupdate.");window.location="../../users/foto.php";</script>';
            exit;
        }
    }
        $sql=mysqli_query($c,"SELECT * FROM foto WHERE fotoid= '".$_GET['id']."'");
            if(mysqli_num_rows($sql) == 0){
                echo '<script>window.location="editfoto.php"</script>';
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
        <title>Edit Foto - Gallery</title>
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
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card transparent-card mt-5" > 
                        <div class="card-header text-center">
                            Edit Foto
                        </div>
                        <div class="card-body text-center">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="albumid" value="<?php echo $d['fotoid'] ?>">
                                <div class="form-group">
                                    <label class="form-label">Judul Foto</label>
                                    <input type="text" name="judulfoto" value="<?php echo $d['judulfoto'] ?>" class="form-control text-center">
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Deskripsi Foto</label>
                                    <input type="text" class="form-control text-center" name="deskripsifoto" value="<?php echo $d['deskripsifoto'] ?>" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Album</label>
                                    <select class="form-control text-center" name="albumid">
                                        <?php
                                        $userid = $_SESSION['userid'];
                                        $sql_a = mysqli_query($c,"SELECT * FROM album WHERE userid='$userid'");
                                        while($da = mysqli_fetch_array($sql_a)) {
                                        ?>
                                        <option <?php if($da['albumid'] == $d['albumid']) {?> selected="selected" <?php } ?> value="<?php echo $da['albumid'] ?>">
                                        <?php echo $da['namaalbum'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Foto</label> <br>
                                    <img src="../../assets/img/<?php echo $d['lokasifile'] ?>" width="150">
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label"> Ganti File</label>
                                    <input type="file" name="lokasifile" class="form-control" value="<?php echo $d['judulfoto'] ?>">
                                </div>
                                <button type="submit" class="btn mt-3 rounded-pill" name="edit2">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                            <?php
            }
                            ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>

    </body>
</html>
