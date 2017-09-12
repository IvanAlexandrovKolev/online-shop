<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['delete_promo'])) {
    $promocode_id = $mysqli->real_escape_string($_POST['delete_promo']);
    $soft_delete_categ = "UPDATE  promocodes SET deleted = 1 WHERE id = {$promocode_id}";
    $delete_from_categ = $mysqli->query($soft_delete_categ);
    if($mysqli->affected_rows == 1){
        $message = "Promocode deleted successfully";
    } else {
        $er_message = "Such promocode deosn't exist.";
    }
}

if (isset($_GET['action']) && $_GET['action'] == "create") {
    $create = true;
    if (isset($_POST['promocode'])) {
        $promocode = mysqli_real_escape_string($mysqli, $_POST['promocode']);
        $promocode_len = mb_strlen($promocode);
        $error = [];
        $new_promocode_query = "INSERT INTO promocodes(promocode,used,many_uses) ";
        if ($promocode_len == 0) {
            $promocode = getToken(15);
            $new_promocode_query .= " VALUES('{$promocode}',0,0)";
        } else if ($promocode_len >= 3 && $promocode_len <= 32) {
            $promocode = htmlspecialchars($promocode);
            $new_promocode_query .= " VALUES('{$promocode}',0,1)";
        } else {
            $error[] = "Promocode must be atleast 3 characters and can be 32(max) characters long";
        }
        if(empty($error)){
            $mysqli->query($new_promocode_query);
            $message = "Promocode created.";
        }
    }
}
//get all promocodes
$promocodes_query = "SELECT * FROM promocodes WHERE used = 0 AND deleted = 0";
$pagenum = 1;
$page_rows = 10;
$pagination_url = "promocodes?";
if (isset($_GET['pn'])) {
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
    $pagenum = mysqli_real_escape_string($mysqli, $pagenum);
}

$pagination = pagination($promocodes_query, $pagenum, $page_rows, $pagination_url);

$paginationCtrls = $pagination['paginationCtrls'];
$textline1 = "Promocodes <b>{$pagination['rows']}</b>";
$limit = $pagination['limit'];
$order_by = " ORDER BY promocodes.id DESC ";
$promocodes_query .= $order_by . $limit;
$promocodes = $mysqli->query($promocodes_query);
$all_promocodes = array();
while ($promocode = $promocodes->fetch_array()) {
    array_push($all_promocodes, $promocode);
}
if (isset($create)) {
    $smarty->assign('create', $create);
}

$smarty->assign('textline1', $textline1);
$smarty->assign('pagination_ctrls', $paginationCtrls);
$smarty->assign('all_promocodes', $all_promocodes);
$display = "list_promocodes";

//$smarty->display("list_promocodes.tpl");
















