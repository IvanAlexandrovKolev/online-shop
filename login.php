<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST) && !empty($_POST)) {
    $username = mysqli_real_escape_string($mysqli, $_POST["username"]);
    $hpassword = hash('sha512', $_POST['password']);
    //$api = new MyApi("IvanAppId","IvanSecret");
    //$response = $api->login($username,$hpassword);
//
    //if(isset($response["success"])){
    //    $_SESSION = $response["success"];
//
    //    if (isset($_SESSION['c_promocode'])) {
    //        $_SESSION['promocode'] = $_SESSION['c_promocode'];
    //        unset($_SESSION['c_promocode']);
    //    }
//
    //    //transfer products from cart
    //    if ($_SESSION['c_token'] == $_COOKIE['token']) {
    //        $c_token = $_COOKIE['token'];
    //        $tcart_products_sql = "SELECT * FROM cart_products WHERE cookie_token = '{$_COOKIE['token']}'";
    //        $products_in_cart = $mysqli->query($tcart_products_sql);
    //        if ($mysqli->affected_rows > 0) {
    //            while ($product = $products_in_cart->fetch_assoc()) {
    //                $product_id = $product['product_id'];
    //                $quantity = $product['quantity'];
    //                $insert = $mysqli->query("INSERT INTO cart_products(quantity,token,product_id) VALUES($quantity,'{$user['token']}',$product_id)");
    //            }
    //        }
    //        $delete = $mysqli->query("DELETE FROM `cart_products` WHERE cookie_token = '{$c_token}'");
    //    }
    //    header("Location: " . SITE . "products");
    //} else {
    //    $error = $response["fail"];
    //    $smarty->assign('error', $error);
    //}

    $user_sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$hpassword}' AND activated=1";
    $users = $mysqli->query($user_sql);
    $user = $users->fetch_assoc();

    if (!empty($user)) {
        $_SESSION['username'] = $username;
        $_SESSION['token'] = $user['token'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['admin'] = $user['admin'];
        $_SESSION['c_token'] = $user['c_token'];

        if (isset($_SESSION['c_promocode'])) {
            $_SESSION['promocode'] = $_SESSION['c_promocode'];
            unset($_SESSION['c_promocode']);
        }

        //transfer products from cart before register to real user cart
        if ($_SESSION['c_token'] == $_COOKIE['token']) {
            $c_token = $_COOKIE['token'];
            $tcart_products_sql = "SELECT * FROM cart_products WHERE cookie_token = '{$_COOKIE['token']}'";
            $products_in_cart = $mysqli->query($tcart_products_sql);
            if ($mysqli->affected_rows > 0) {
                while ($product = $products_in_cart->fetch_assoc()) {
                    $product_id = $product['product_id'];
                    $quantity = $product['quantity'];
                    $insert = $mysqli->query("INSERT INTO cart_products(quantity,token,product_id) VALUES($quantity,'{$user['token']}',$product_id)");
                }
            }
            $delete = $mysqli->query("DELETE FROM `cart_products` WHERE cookie_token = '{$c_token}'");
        }
        header("Location: " . SITE . "products");
    } else {
        $error[] = "Invalid username or password";
        $smarty->assign('error', $error);
    }
}

$display = "login_form";





