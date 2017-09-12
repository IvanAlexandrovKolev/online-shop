<?php

session_start();

require_once('config.php');
require_once('functions.php');
require_once('database.php');
require_once('class.upload.php-master/src/class.upload.php');
require_once("ajax.php");
require_once("shop.api.php");
require_once ("vendor/autoload.php");
include_once ("niki_api.php");



$page = $_GET["page"];
if(isset($_GET["id"])){
    $id = $_GET["id"];
}

if ($page == "api" && isset($id)) {
    $requested = $id;
    $check_for_api_func = "SELECT * FROM api_functions WHERE `page` = '{$requested}'";
    $page_data = $mysqli->query($check_for_api_func);
    $page_data = $page_data->fetch_assoc();
    if (!empty($page_data)) {
        $php_file = $page_data["function"] . ".php";
        include_once("{$php_file}");
    }
}

$action = "products";
$error = [];
if (!isset($_COOKIE['token'])) {
    $cookie_name = "token";
    $cookie_value = getToken(10);
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
}
$user_status = user_status();

$check_for_page_query = "SELECT * FROM pages WHERE `page` = '{$page}'";

$page_data = $mysqli->query($check_for_page_query);
$page_data = $page_data->fetch_assoc();

if (!empty($page_data)) {
    if ($page_data["type"] == "everyone") {
        $action = $page_data["php_file"];
    } else if ($page_data["type"] == "" && $page_data["is_logged_in"] == $user_status["is_logged_in"] && $page_data["is_admin"] == $user_status["is_admin"]) {
        $action = $page_data["php_file"];
    } else if ($page_data["type"] == "admin" &&
        $page_data["is_admin"] == $user_status["is_admin"]
    ) {
        $action = $page_data["php_file"];
    } else if ($page_data["type"] == "user" &&
        ($page_data["is_logged_in"] == $user_status["is_logged_in"] || $page_data["is_logged_in"] == null)
    ) {
        $action = $page_data["php_file"];
    }
}


include_once("{$action}.php");


$smarty->assign('error', $error);
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
} else if (isset($_SESSION['er_message'])) {
    $er_message = $_SESSION['er_message'];
    unset($_SESSION['er_message']);
}
if (isset($message)) {
    $smarty->assign("message", $message);
} else if (isset($er_message)) {
    $smarty->assign("er_message", $er_message);
}
$smarty->display($display . '.tpl');

?>


