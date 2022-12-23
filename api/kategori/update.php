<?php
header('Content-Type: application/json');

include dirname(dirname(__FILE__)).'/db/Db.class.php';

$db = new Db();

$cat_id = isset($_POST['cat_id']) ? (int) $_POST['cat_id'] : '';
$cat_name = isset($_POST['cat_name']) ? $_POST['cat_name'] : '';
$cat_description = isset($_POST['cat_description']) ? $_POST['cat_description'] : '';

if (empty($cat_id) OR empty($cat_name)) {
    $arr = array();
    $arr['info'] = 'error';
    $arr['msg'] = 'ID atau nama Kategori tidak ada, coba pastikan lagi';

    echo json_encode($arr);
    exit();
}

$datas = array();
$datas['cat_name'] = $cat_name;
$datas['cat_description'] = $cat_description;
$datas['cat_modified'] = date('Y-m-d H:i:s');

$exec = $db->update('kategori', $datas,' where cat_id='.$cat_id);

if (!$exec) {
    $arr = array();
    $arr['info'] = 'error';
    $arr['msg'] = 'Query tidak berhasil dijalankan.';

    echo json_encode($arr);
    exit();
}

$arr = array();
$arr['info'] = 'success';
$arr['msg'] = 'Data berhasil diproses.';
echo json_encode($arr);
