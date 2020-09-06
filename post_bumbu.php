<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include dirname(dirname(__FILE__)).'/maktam_api_new/db/Db.class.php';
$db = new Db();
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$bumbu = isset($_POST['bumbu']) ? $_POST['bumbu'] : '';
$stock_dingin = isset($_POST['stock_dingin']) ? $_POST['stock_dingin'] : '0';
$stock_hangat = isset($_POST['stock_hangat']) ? $_POST['stock_hangat'] : '0';
$terjual_dingin = isset($_POST['terjual_dingin']) ? $_POST['terjual_dingin'] : '0';
$terjual_hangat = isset($_POST['terjual_hangat']) ? $_POST['terjual_hangat'] : '0';
$sisa_dingin = isset($_POST['sisa_dingin']) ? $_POST['sisa_dingin'] : '0';
$sisa_hangat = isset($_POST['sisa_hangat']) ? $_POST['sisa_hangat'] : '0';
$outlet = isset($_POST['outlet']) ? $_POST['outlet'] : '';
$state = isset($_POST['state']) ? $_POST['state'] : '';


if($state == "0"){
    $cat_list = $db->query("INSERT INTO `maktam_bumbu` (`id`, `tanggal`, `bumbu`, `stock_dingin`, `stock_hangat`, `terjual_dingin`, `terjual_hangat`, `sisa_dingin`, `sisa_hangat`, `outlet`) VALUES (NULL, '$tanggal', '$bumbu', '$stock_dingin', '$stock_hangat', '$terjual_dingin', '$terjual_hangat', '$sisa_dingin', '$sisa_hangat', '$outlet');");
    $arr = array();
    $arr['info'] = 'success';
    $arr['num'] = count($cat_list);
    $arr['result'] = $cat_list;
    echo json_encode($arr);
}else{
    $cat_list = $db->query("UPDATE `maktam_bumbu` SET `stock_dingin` = '$stock_dingin', `stock_hangat` = '$stock_hangat', `terjual_dingin` = '$terjual_dingin', `terjual_hangat` = '$terjual_hangat', `sisa_dingin` = '$sisa_dingin', `sisa_hangat` = '$sisa_hangat' WHERE `maktam_bumbu`.`outlet` = '$outlet' AND `maktam_bumbu`.`bumbu` = '$bumbu' AND `maktam_bumbu`.`tanggal` = '$tanggal';");
    $arr = array();
    $arr['info'] = 'success';
    $arr['num'] = count($cat_list);
    $arr['result'] = $cat_list;
    echo json_encode($arr);
}
