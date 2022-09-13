<?php
header('Content-Type: application/json');

include dirname(dirname(__FILE__)).'/db/Db.class.php';

$db = new Db();

$cat_id = isset($_POST['cat_id']) ? (int) $_POST['cat_id'] : '';

if (empty($cat_id)) {
    $arr = array();
    $arr['info'] = 'error';
    $arr['msg'] = 'ID Kategori tidak ditemukan';

    echo json_encode($arr);
    exit();
}

$db->query('delete from kategori where cat_id='.$cat_id);

$arr = array();
$arr['info'] = 'success';
$arr['msg'] = 'Data berhasil dihapus.';
echo json_encode($arr);
