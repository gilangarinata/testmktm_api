<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$outlet = $_POST['outlet'];
//$tanggal = $_POST['tanggal'];


$sql="SELECT * FROM maktam_set WHERE outlet='$outlet' ORDER BY id DESC LIMIT 1";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo $row['dataset'];
    }
}
?>