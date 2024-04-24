<?php
session_start();
include '../connect.php';



$fotoid = $_POST['fotoid'];
$userid = $_SESSION['userid'];
$isikomen = $_POST['isikomen'];
$tglkomen = date('Y-m-d');

$query = mysqli_query($c, "INSERT INTO komentarfoto VALUES('','$fotoid','$userid','$isikomen','$tglkomen')");
echo"<script>
location.href='../../users/dashboard.php';
</script>" ;

?>