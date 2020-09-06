<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include dirname(dirname(__FILE__)).'/maktam_api_new/db/Db.class.php';
$db = new Db();
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$outlet = isset($_POST['outlet']) ? $_POST['outlet'] : '';

$sql_name = '';
if (!empty($tanggal) && !empty($outlet)) {
    $sql_name = ' where tanggal LIKE \'%'.$tanggal.'%\' AND outlet LIKE \'%'.$outlet.'%\' ';
}
$cat_list = $db->query('select * from maktam_bumbu '.$sql_name);
$arr = array();
$arr['info'] = 'success';
$arr['num'] = count($cat_list);
$arr['result'] = $cat_list;
echo json_encode($arr);