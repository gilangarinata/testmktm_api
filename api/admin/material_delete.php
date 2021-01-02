<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$id=$_POST['id'];

$sql = "UPDATE `maktam_add_mate` SET `material` = '0' WHERE `maktam_add_mate`.`id` = '$id';";
mysqli_query($conn, $sql)

?>