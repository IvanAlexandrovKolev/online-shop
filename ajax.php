<?php
include_once "config.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['promo'])) {
    //ajax
    $check_promocode = $mysqli->real_escape_string($_POST['promo']);
    $check_promocode_query = "SELECT * FROM promocodes WHERE promocode = '{$check_promocode}' AND used = 0 AND deleted = 0";
    $mysqli->query($check_promocode_query);
    if ($mysqli->affected_rows > 0) {
        if (isset($_SESSION['username'])) {
            $_SESSION['promocode'] = $check_promocode;
        } else {
            $_SESSION['c_promocode'] = $check_promocode;
        }
        echo $data = true;
    } else {
        echo $data = false;
    }
    die;
}
if (isset($_POST['function']) && $_POST['function'] == "fillSubcats") {
    global $mysqli;
    //ajax
    $category_id = $mysqli->real_escape_string($_POST['category_id']);
    $check_subcats_query = "SELECT * FROM subcategories WHERE category_id = {$category_id}";
    $subcategories = $mysqli->query($check_subcats_query);
    $all_subcategories = array();
    if ($mysqli->affected_rows > 0) {
        while ($subcategory = $subcategories->fetch_array()) {
            array_push($all_subcategories, $subcategory);
        }
        echo json_encode($all_subcategories);
    }
    die();
}
if (isset($_POST['update_quantity'])) { //this comes from ajax
    $prod_id = mysqli_real_escape_string($mysqli, $_POST['prod_id']);
    $quantity = mysqli_real_escape_string($mysqli, $_POST['quantity']);

    if (is_numeric($prod_id) && is_numeric($quantity)) {
        $quantity = intval($quantity);
        $prod_id = intval($prod_id);
        //check if products exists
        if (isset($_SESSION['username'])) {
            $token = $_SESSION['token'];
            $table = "cart_products";
            $table_token = "token";
        } else {
            $token = $_COOKIE['token'];
            $table = "temp_cart";
            $table_token = "cookie_token";
        }
        $update_quantity_sql = "UPDATE {$table} SET quantity = {$quantity} WHERE {$table_token} = '{$token}' AND product_id = {$prod_id}";
        $mysqli->query($update_quantity_sql);
        $query_sum = "SELECT SUM({$table}.quantity*products.price) as total
                      FROM {$table} 
                      JOIN products ON {$table}.product_id = products.id 
                      WHERE {$table}.{$table_token} = '{$token}'";
        $sum = $mysqli->query($query_sum);
        $result = $sum->fetch_assoc();

        $total = $result["total"];
        if (isset($_SESSION['promocode']) || isset($_SESSION['c_promocode'])) {
            $total -= 20 / 100 * $total;
        }
        $total = round($total, 2);
        echo $total;
    }
    die;
}