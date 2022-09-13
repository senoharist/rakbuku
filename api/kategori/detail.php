<?php
header('Content-Type: application/json');

include dirname(dirname(__FILE__)).'/db/Db.class.php';

$db = new Db();

$cat_id = isset($_GET['cat_id']) ? (int) $_GET['cat_id'] : 0;

$cat_detail = $db->row('select * from kategori where cat_id='.$cat_id);

$arr = array();
$arr['info'] = 'success';
$arr['result'] = $cat_detail;
echo json_encode($arr);
