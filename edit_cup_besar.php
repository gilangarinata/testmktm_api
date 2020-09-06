<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include dirname(dirname(__FILE__)).'/maktam_api_new/db/Db.class.php';
$db = new Db();
$stock_dingin = isset($_POST['stock_dingin']) ? $_POST['stock_dingin'] : '';
$stock_hangat = isset($_POST['stock_hangat']) ? $_POST['stock_hangat'] : '';
$terjual_dingin = isset($_POST['terjual_dingin']) ? $_POST['terjual_dingin'] : '';
$terjual_hangat = isset($_POST['terjual_hangat']) ? $_POST['terjual_hangat'] : '';
$sisa_dingin = isset($_POST['sisa_dingin']) ? $_POST['sisa_dingin'] : '';
$sisa_hangat = isset($_POST['sisa_hangat']) ? $_POST['sisa_hangat'] : '';
$outlet = isset($_POST['outlet']) ? $_POST['outlet'] : '';
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';

$cat_list = $db->query("UPDATE `maktam_cup_besar` SET `stock_dingin` = '$stock_dingin', `stock_hangat` = '$stock_hangat', `terjual_dingin` = '$terjual_dingin', `terjual_hangat` = '$terjual_hangat', `sisa_dingin` = '$sisa_dingin', `sisa_hangat` = '$sisa_hangat' WHERE `maktam_cup_besar`.`outlet` = '$outlet' AND `maktam_cup_besar`.`tanggal` = '$tanggal';");
$arr = array();
$arr['info'] = 'success';
$arr['num'] = count($cat_list);
$arr['result'] = $cat_list;
echo json_encode($arr);