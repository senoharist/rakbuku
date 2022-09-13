<?php
include 'inc.php';

$cat_name = isset($_POST['cat_name']) ? $_POST['cat_name'] : '';

if (!empty($cat_name)) {
    //proses submit ke API

    $cat_description = isset($_POST['cat_description']) ? $_POST['cat_description'] : '';

    $url = $api_url.'/kategori/create.php';
    $postdata = array();
    $postdata['cat_name'] = $cat_name;
    $postdata['cat_description'] = $cat_description;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($postdata,'','&'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $response = curl_exec ($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close ($ch);

    $arr_response = json_decode($response, true);
    $info = isset($arr_response['info']) ? $arr_response['info'] : 'error';
    $msg = isset($arr_response['msg']) ? $arr_response['msg'] : 'tidak diketahui';

    header('location:kategori-add.php?info='.$info.'&msg='.$msg);
    exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Add Kategori</title>
</head>

<body>
    <h1>Add Kategori</h1>

    <?php
    $info = isset($_GET['info']) ? $_GET['info'] : '';
    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';

    if (!empty($info)) {
        echo 'Info: '.$info;
        echo '<br />Msg: '.$msg;
        echo '<br />';
    }
    ?>

    <p><a href="kategori.php">&laquo; Back</a> | <a href="kategori-add.php">Reload</a></p>

    <form method="POST" action="">
        <table border="1">
            <tr>
                <td>Nama Kategori</td>
                <td>:</td>
                <td><input type="text" name="cat_name" size="50"></td>
            </tr>
            <tr>
                <td>Keterangan Kategori</td>
                <td>:</td>
                <td><input type="text" name="cat_description" size="50"></td>
            </tr>
        </table>

        <p>
            <input type="submit" name="sbm" value="Submit" />
        </p>
    </form>

</body>

</html>
