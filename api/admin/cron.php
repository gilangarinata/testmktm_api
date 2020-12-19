<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$tanggal = date('d/m/Y');
$tomorrow = date('d/m/Y', strtotime(date('m/d/Y') .' +1 day'));
$sisa;
$stock;
$sql="SELECT * FROM maktam_stock WHERE date='$tanggal'";
$result=mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)>0){
     while($row=mysqli_fetch_assoc($result)){
         $sisa=$row['sisa'];
         $stock=$row['stock'];
     }
 }
 $sql="SELECT * FROM maktam_stock WHERE date='$tomorrow'";
 $result=mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)>0){
    $sql = "UPDATE `maktam_stock` SET `stock` = '$sisa', `sisa` = '', `date` = '$tomorrow' WHERE `maktam_stock`.`date` = '$tomorrow';";
    $result = mysqli_query($conn,$sql);
    writeLog($sisa,$stock,$tomorrow,"UPDATES",$result);
 }else{
    if(empty($sisa)){
        $sql = "INSERT INTO `maktam_stock` (`id`, `stock`, `sisa`, `date`) VALUES (NULL, '$stock', '', '$tomorrow');";
        $result = mysqli_query($conn,$sql);
        writeLog($sisa,$stock,$tomorrow,"INSERTS EMPTY SISA",$result);
    }else{
        $sql = "INSERT INTO `maktam_stock` (`id`, `stock`, `sisa`, `date`) VALUES (NULL, '$sisa', '[]', '$tomorrow');";
        $result = mysqli_query($conn,$sql);
        writeLog($sisa,$stock,$tomorrow,"INSERTS AVAILABLE SISA",$result);
    }
 }

 function writeLog($sisa,$stock,$date,$status,$result){
    $log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
    "Attempt: ".($result[0]['success']=='1'?'Success':'Failed').PHP_EOL.
    "Date : .$date".PHP_EOL.
    "Stock : .$stock".PHP_EOL.
    "Sisa : .$sisa".PHP_EOL.
    "Status : .$status".PHP_EOL;
    file_put_contents('/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
 }

?>