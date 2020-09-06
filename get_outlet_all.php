<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include dirname(dirname(__FILE__)).'/maktam_api_new/db/Db.class.php';
$db = new Db();
$cat_list = $db->query("SELECT * FROM `maktam_login`");
$arr = array();
$arr['info'] = 'success';
$arr['num'] = count($cat_list);
$arr['result'] = $cat_list;
echo json_encode($arr);