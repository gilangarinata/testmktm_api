<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include dirname(dirname(__FILE__)).'/maktam_api_new/db/Db.class.php';
$db = new Db();
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$outlet = isset($_POST['outlet']) ? $_POST['outlet'] : '';

$cat_list = $db->query("DELETE FROM `maktam_cup_besar` WHERE `maktam_cup_besar`.`tanggal` = '$tanggal' AND `maktam_cup_besar`.`outlet` = '$outlet'");
$arr = array();
$arr['info'] = 'success';
$arr['num'] = count($cat_list);
$arr['result'] = $cat_list;
echo json_encode($arr);