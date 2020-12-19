<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include dirname(dirname(__FILE__)).'/maktam_api_new/db/Db.class.php';
$db = new Db();

// $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$tanggal = date('m/d/Y');
$tanggal2 = date('d/m/Y');

$tomorrow = date('d/m/Y', strtotime($tanggal .' +1 day'));

$sql_name = '';
if (!empty($tanggal)) {
    $sql_name = ' where tanggal LIKE \'%'.$tanggal.'%\'';
}
$cat_list = $db->query('select * from maktam_cup_besar '.$sql_name);
$arr = array();
$arr['info'] = 'success';
$arr['num'] = count($cat_list);
$arr['result'] = $cat_list;
echo json_encode($arr);


?>
<?php
header('Access-Control-Allow-Origin: *');
require_once("../koneksi.php");

$tanggal = date('m/d/Y');
$tanggal2 = date('d/m/Y');
//  $tanggal = "05/04/2020";
//  $tanggal2 = "05/06/2020";
 
$tomorrow = date('d/m/Y', strtotime($tanggal .' +1 day'));
$sisa=0;
$stock=0;
$sql="SELECT * FROM maktam_stock WHERE date='$tanggal2'";
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
    $avail = true;
 }else{
     $avail=false;
 }

 if($avail==false){
     if($sisa=='[]'){
         echo 'sisa []';
        $sql = "INSERT INTO `maktam_stock` (`id`, `stock`, `sisa`, `date`) VALUES (NULL, '$stock', '[]', '$tomorrow');";
        $result = mysqli_query($conn,$sql);
     }else{
                  echo 'sisa tdk []';
        $sql = "INSERT INTO `maktam_stock` (`id`, `stock`, `sisa`, `date`) VALUES (NULL, '$sisa', '[]', '$tomorrow');";
        $result = mysqli_query($conn,$sql);
     }
 }else{
              echo 'update';
    $sql = "UPDATE `maktam_stock` SET `stock` = '$sisa', `sisa` = '[]', `date` = '$tomorrow' WHERE `maktam_stock`.`date` = '$tomorrow';";
    $result = mysqli_query($conn,$sql);
 }



?>