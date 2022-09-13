<?php
header('Content-Type: application/json');

include dirname(dirname(__FILE__)).'/db/Db.class.php';

$db = new Db();

$cat_name = isset($_POST['cat_name']) ? $_POST['cat_name'] : '';
$cat_description = isset($_POST['cat_description']) ? $_POST['cat_description'] : '';

if (empty($cat_name)) {
    $arr = array();
    $arr['info'] = 'error';
    $arr['msg'] = 'Kategori tidak ada';

    echo json_encode($arr);
    exit();
}

$datas = array();
$datas['cat_name'] = $cat_name;
$datas['cat_description'] = $cat_description;
$datas['cat_created'] = date('Y-m-d H:i:s');
$datas['cat_modified'] = date('Y-m-d H:i:s');

$exec = $db->insert('kategori', $datas);

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
