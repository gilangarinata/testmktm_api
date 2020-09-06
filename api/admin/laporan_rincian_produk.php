<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");
error_reporting( error_reporting() & ~E_NOTICE );
$tanggal = $_POST['tanggal'];
//$tanggal = "23/07/2019";
$result_array = array();
$data = array();
$outlets = array();
$produk = array();
$rasa = array();
$dingin = array();
$terjual = array();
$sisa = array();
$total_terjual = array();
$total_sisa = array();


$sql="SELECT * FROM maktam_produk";
$result=mysqli_query($conn,$sql);
$i = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $produk[$i]=$row['produk'];
        $rasa[$i]=json_decode($row['rasa1']);
        $i++;
    }
}

$sql="SELECT * FROM maktam_login WHERE username != 'Admin'";
$result=mysqli_query($conn,$sql);
$i = 0;

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $outlets[$i]=$row['outlet'];
        $i++;
    }
}
$pendapatan = 0;
    for($j=0; $j<sizeof($outlets); $j++){
    $sql="SELECT * FROM maktam_other WHERE outlet='$outlets[$j]' and date='$tanggal'";
    $result=mysqli_query($conn,$sql);
    $length = 0;
    $p = 0;
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $dingin = json_decode($row['icecream']);
            $pendapatan = $pendapatan + $dingin[5];


            $length = array_sum($dingin[9]) + $dingin[8];
            for($i=0; $i<$length; $i++){
                $terjual[$i] = $dingin[10 + $length + $i];
                $sisa[$i] = $dingin[10 + 2*$length + $i];
                $total_terjual[$i] = $total_terjual[$i] + $terjual[$i];
                $total_sisa[$i] = $sisa[$i];                     
            }
       
        }
        
         
        
    }else{
            $dingin = array();
            $total_terjual = array();
            $total_sisa = array();
            $terjual = array();
            $sisa = array();

    }


    $data["outlet"] = $outlets[$j];
    $data["data"] = json_encode($dingin);
    $data["terjual"] = json_encode($total_terjual);
    $data["sisa"] = json_encode($total_sisa);
    array_push($result_array, $data);
    
    $total_terjual = array();
}
$data["produk"] = json_encode($produk);
$data["rasa"] = json_encode($rasa);
$data["pendapatan"] = json_encode($pendapatan);


array_push($result_array,$data);
    
echo json_encode($result_array);
?>