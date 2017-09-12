<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$orders_pagination_query = "SELECT order_token FROM bought_products ";

$clean_order_query = "SELECT bought_products.quantity, users.username, product_id, `date`, promocode, order_token, current_price, `name`, image_name
                      FROM bought_products 
                      JOIN users ON bought_products.token = users.token 
                      JOIN products ON bought_products.product_id = products.id";

$pagination_url = "";
$error = [];
if ($_SESSION['admin'] == 1) {
    if (isset($_GET['search_by']) && isset($_GET['search_text'])) {
        $search_text = htmlspecialchars($_GET["search_text"]);
        $search_text_len = mb_strlen($search_text);
        $search_text = $mysqli->real_escape_string($search_text);
        $search_by = $mysqli->real_escape_string($_GET["search_by"]);
        $targets = array("username", "order_id");
        if (!in_array($search_by, $targets)) {
            $error = "Invalid 'search by' clause";
        }
        if ($search_text_len > 0) {
            if ($search_text_len < 3) {
                $error[]= "Search text must be atleast 3 characters long.";
            } else {
                $error[]= "Search text could be max 64 characters long.";
            }
        } else {
            $error[]= "All fields must be filled.";
        }
        if (empty($error)) {
            if ($search_by == "username") {
                $orders_pagination_query .= " JOIN users ON bought_products.token = users.token ";
            }
            $orders_pagination_query .= " WHERE `{$search_by}` LIKE '%{$search_text}%'";
            $pagination_url .= "search_by={$search_by}&search_text={$search_text}";
        }
    }
} else {
    $token = $_SESSION['token'];
    $orders_pagination_query .= " WHERE token = '{$token}'";
}
if (isset($_GET['pn'])) {
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
    $pagenum = $mysqli->real_escape_string($pagenum);
} else {
    $pagenum = 1;
}
$orders_pagination_query .= " GROUP BY order_token";

$page_rows = 5;
if (mb_strlen($pagination_url) > 0) {
    $pagination_url .= "&";
}
$pagination_url = "orders?" . $pagination_url;

$pagination = pagination($orders_pagination_query, $pagenum, $page_rows, $pagination_url);

$paginationCtrls = $pagination['paginationCtrls'];
$rows = $pagination['rows'];

$limit = $pagination['limit'];
$order_by = " ORDER BY `date` DESC ";
$orders_pagination_query .= $order_by . $limit;
$order_tokens = $mysqli->query($orders_pagination_query);

$all_orders = array();

if($rows > 0){
    while ($result = $order_tokens->fetch_assoc()) {
        $group = array();
        $orders_query = $clean_order_query;
        $order_token = $result['order_token'];
        $orders_query .= " WHERE order_token = '{$order_token}'";
        $order = $mysqli->query($orders_query);
        $total = 0;
        while ($product = $order->fetch_array()) {
            array_push($group, $product);
            $total += $product["quantity"] * $product["current_price"];
            $promocode = $product['promocode'];
        }

        if ($promocode != '1') {
            $total -= 0.2 * $total;
        }
        array_push($group, round($total, 2));
        array_push($all_orders, $group);
    }
} else {
    $rows = "You haven't purchased any products yet.";
}

if (isset($searched) && isset($search_by)) {
    $smarty->assign('search_text', $searched);
    $smarty->assign('search_by', $search_by);
}
if(isset($all_orders)){
    $smarty->assign('all_groups', $all_orders);
}
$smarty->assign('textline1', $rows);
$smarty->assign('pagination_ctrls', $paginationCtrls);
$display = "list_orders";
?>

