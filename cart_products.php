<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use PayPal\Api\Item;


if (isset($_POST['discard_product'])) {
    $prod_id =$mysqli->real_escape_string($_POST['discard_product']);
    if (isset($_SESSION['token'])) {
        $token = $_SESSION['token'];
        $query = " token = '{$token}' ";
    } else {
        $token = $_COOKIE['token'];
        $query = " cookie_token = '{$token}' ";
    }
    $delete_query = "DELETE FROM `cart_products` WHERE ".$query." AND product_id = {$prod_id}";
    $mysqli->query($delete_query);
    if ($mysqli->affected_rows == 1) {
        $message = "Product has been discarded";
        $smarty->assign("message", $message);
    } else {
        $er_message = "Such product doesn't exist.";
        $smarty->assign("er_message", $er_message);
    }
}
if (isset($_POST['buy_products'])) {
    $data = [];
    $data['order_token'] = getToken(10);
    if (isset($_SESSION['username'])) {
        $token = $_SESSION['token'];
        if (isset($_SESSION['promocode'])) {
            $data['promocode'] = $_SESSION['promocode'];
        } else {
            $data['promocode'] = '1';
        }
        $user_cart_query =
            "SELECT cart_products.quantity AS CP_quan,products.quantity AS P_quan,products.id AS product_id,products.name AS name,price FROM cart_products 
             JOIN products ON cart_products.product_id = products.id
             WHERE token ='{$token}'";
        $cart_products = $mysqli->query($user_cart_query);
        $error = [];
        $items = [];
        while ($product = $cart_products->fetch_array()) {
            $data['quantity_left'] = $product['P_quan'] - $product['CP_quan'];
            $data['quantity_wanted'] = $product['CP_quan'];
            $data['price'] = $product['price'];
            $data['product_id'] = $product['product_id'];
            $data['date'] = strtotime("now");
            $product_name = $product['name'];
            $total = 0;
            $mysqli->begin_transaction();

            if ($data['quantity_left'] >= 0) {
                $item = new Item();
                $item->setName($product["name"])
                    ->setCurrency('USD')
                    ->setQuantity($data['quantity_wanted'])
                    ->setSku("321321")
                    ->setPrice($product['price']);

                $items[] = $item;
                $total += $data['quantity_wanted'] * $product['price'];
                $insert_bought_prods_query =
                    "INSERT INTO bought_products(quantity,token,product_id,date,promocode,order_token,current_price) 
                     VALUES({$data['quantity_wanted']},'{$token}',{$data['product_id']},'{$data['date']}','{$data['promocode']}','{$data['order_token']}',{$data['price']})";
                $update_prods_query = "UPDATE `products` SET quantity = {$data['quantity_left']} WHERE id = {$data['product_id']}";
                $delete_cart_query = "DELETE FROM `cart_products` WHERE token = '{$token}'";

                $mysqli->query($insert_bought_prods_query);
                $mysqli->query($update_prods_query);
                $mysqli->query($delete_cart_query);
            } else {
                $error[] = "There is not enough quantity from {$product_name}.We have {$product['P_quan']} left and you wanted {$product['CP_quan']}." . "</br>";
            }
        }
        if (empty($error)) {
            $mysqli->commit();

            if (isset($_SESSION['promocode'])) {
                $query_promocode = "SELECT * FROM promocodes WHERE promocode = '{$data['promocode']}'";
                $promocode_info = $mysqli->query($query_promocode);
                $promocode = $promocode_info->fetch_assoc();
                if ($promocode['many_uses'] == 0) {
                    $query_update_promo = "UPDATE promocodes SET used = 1 WHERE `promocode`='{$data['promocode']}'";
                    $mysqli->query($query_update_promo);
                }
                unset($_SESSION['promocode']);
            }
            include_once "paypal_app.php";


        } else {
            $mysqli->rollback();
            $smarty->assign('error', $error);
        }
    } else {
        print_r("In order to continue please register <a href='" . SITE . "register'>here</a>.");
        die();
    }
}

if (isset($_GET['pn'])) {
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
    $pagenum = mysqli_real_escape_string($mysqli, $pagenum);
} else {
    $pagenum = 1;
}
if (isset($_SESSION['username'])) {
    $token = " WHERE token = '{$_SESSION['token']}'";
} else {
    $token = " WHERE cookie_token = '{$_COOKIE['token']}'";
}
$cart_sql = "SELECT products.id as id,cart_products.quantity as quantity, name,description,price,image_name,deleted,big_image_name 
             FROM cart_products
             JOIN products ON cart_products.product_id = products.id" . $token;
$page_rows = 10;

$pagination_url = "cart?";
$pagination = pagination($cart_sql, $pagenum, $page_rows, $pagination_url);

$paginationCtrls = $pagination['paginationCtrls'];
$rows = $pagination['rows'];
$limit = $pagination['limit'];
$order_by = " ORDER BY cart_products.id DESC";

if ($rows > 0) {
    $cart_sql .= $order_by . $limit;
    $total_price = 0;
    $cart_products = $mysqli->query($cart_sql);
    $all_products = array();
    while ($product = $cart_products->fetch_assoc()) {
        array_push($all_products, $product);
        $total_price += $product['quantity']*$product['price'];
    }
    if (isset($_SESSION['promocode']) || isset($_SESSION['c_promocode'])) {
        $total_price -= 0.2 * $total_price;
    }
    $total_price = round($total_price,2);

    $smarty->assign('total_price', $total_price);
    $smarty->assign('textline1', $rows);
    $smarty->assign('all_products', $all_products);
    $smarty->assign('pagination_ctrls', $paginationCtrls);
} else {
    $smarty->assign('empty', "Your cart is currently empty");
}
$display = "list_cart_products";



?>

