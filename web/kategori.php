<?php
include 'inc.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Kategori</title>
    </head>
    <script type="text/javascript">
        function deleteData(cat_id) {
            var cfm = confirm("Apakah anda yakin akan menghapus data ini?");
            if (cfm) {
                window.location.href='kategori-del.php?cat_id='+cat_id;
            }
        }
    </script>
    <body>
    <?php
    $api_categories_list = $api_url.'/kategori/list.php';
    $json_list = @file_get_contents($api_categories_list);
    ?>

    <h1>Kategori</h1>

    <?php
    $info = isset($_GET['info']) ? $_GET['info'] : '';
    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';

    if (!empty($info)) {
        echo 'Info: '.$info;
        echo '<br />Msg: '.$msg;
        echo '<br />';
    }
    ?>

    <p><a href="kategori-add.php">Add New</a> | <a href="kategori.php">Reload</a></p>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Keterangan</th>
            <th>Entry</th>
            <th>Update</th>
            <th>Action</th>
        </tr>
        <?php
        $array = json_decode($json_list, true);
        $result = isset($array['result']) ? $array['result'] : array();

        $no = 0;
        foreach($result as $arr) {
            $no++;

            $link_edit = '<a href="kategori-edit.php?cat_id='.$arr['cat_id'].'">[Edit]</a>';
            $link_delete = '<a href="javascript:void:;" onclick="deleteData(\''.$arr['cat_id'].'\')">[Delete]</a>';

            echo '
            <tr>
                <td>'.$no.'</td>
                <td>'.$arr['cat_name'].'</td>
                <td>'.$arr['cat_description'].'</td>
                <td>'.date('d M Y H:i', strtotime($arr['cat_created'])).'</td>
                <td>'.date('d M Y H:i', strtotime($arr['cat_modified'])).'</td>
                <td>'.$link_edit.' '.$link_delete.'</td>
            </tr>
            ';
        }
        ?>
    </table>
    </body>
</html>
