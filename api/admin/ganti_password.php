<?php
header('Access-Control-Allow-Origin: *');
session_start();
require_once("../koneksi.php");
$password_lama=$_POST["password_lama"];
$password_baru=$_POST["password_baru"];
$password_baru2=$_POST["password_baru2"];

$sql = "SELECT * FROM maktam_login WHERE username='admin' and password='$password_lama'" ;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $sql = "UPDATE `maktam_login` SET `password` = '$password_baru' WHERE `maktam_login`.`username` = 'admin';";
    mysqli_query($conn, $sql);
    echo 200;
}else{
   echo 504;
}
?>	

