<?php
session_start();
include '../connect.php';
$fotoid = $_GET['fotoid'];
$userid = $_SESSION['userid'];

$liked = mysqli_query($c, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

if(mysqli_num_rows($liked) == 1){
    while($row = mysqli_fetch_array($liked)){
        $likeid = $row['likeid'];
        $query = mysqli_query($c, "DELETE FROM likefoto WHERE likeid='$likeid'");
        echo "
        <script>
        location.href='../../users/dashboard.php';
        </script>
        ";
    }
}else{



$tgllike = date('Y-m-d');
$query = mysqli_query($c, "INSERT INTO likefoto VALUES('','$fotoid','$userid','$tgllike')");

echo "
    <script>
    location.href='../../users/dashboard.php';
    </script>
    ";

}
?>