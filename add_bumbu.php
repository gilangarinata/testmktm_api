<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include dirname(dirname(__FILE__)).'/maktam_api_new/db/Db.class.php';
$db = new Db();
$bumbu = isset($_POST['bumbu']) ? $_POST['bumbu'] : '';

$cat_list = $db->query("INSERT INTO `maktam_bumbu_add` (`id`, `bumbu`) VALUES (NULL, '$bumbu');");
$arr = array();
$arr['info'] = 'success';
$arr['num'] = count($cat_list);
$arr['result'] = $cat_list;
echo json_encode($arr);