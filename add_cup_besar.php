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

$cat_list = $db->query("INSERT INTO `maktam_cup_besar` (`id`, `stock_dingin`, `stock_hangat`, `terjual_dingin`, `terjual_hangat`, `sisa_dingin`, `sisa_hangat`, `outlet`, `tanggal`) VALUES (NULL, '$stock_dingin', '$stock_hangat', '$terjual_dingin', '$terjual_hangat', '$sisa_dingin', '$sisa_hangat', '$outlet', '$tanggal');");
$arr = array();
$arr['info'] = 'success';
$arr['num'] = count($cat_list);
$arr['result'] = $cat_list;
echo json_encode($arr);