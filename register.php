<?php
if(!defined("SHOP")){
    header("Location: logout");
}
if (isset($_GET['token']) && isset($_GET['email']) && isset($_GET['id'])) {
    session_start();
    $token = $mysqli->real_escape_string($_GET['token']);
    $email = $mysqli->real_escape_string($_GET['email']);
    $id = $mysqli->real_escape_string($_GET['id']);

    $activate_user_query = "UPDATE `users` SET activated = 1 WHERE `token`='{$token}' AND `id` = {$id} AND `email` = '{$email}'";
    $update = $mysqli->query($activate_user_query);
    if ($mysqli->affected_rows == 1) {
        $_SESSION['message'] = "You can now enter your account.";
    } else {
        $_SESSION['er_message'] = "Such user doesn't exist.";
    }
    header("Location: " . SITE . "login");
    die;
}
if (isset($_POST['register'])) {
    $data = array();
    $error = [];
    $user['activated'] = 0;
    $user['token'] = getToken(10);
    $user['c_token'] = $_COOKIE['token'];
    //username
    if (preg_match('/^[A-Za-z0-9]{5,32}$/', $_POST["username"])) {
        $user['username'] = $mysqli->real_escape_string($_POST["username"]);

        $check_username = "SELECT * FROM users WHERE username = '{$user['username']}'";
        $mysqli->query($check_username);
        if ($mysqli->affected_rows > 0) {
            $error []= "Username already taken.";
        }
    } else {
        $error[]= 'Username must be between 5 and 32 characters long and contain only letters and numbers.';
    }

    //email
    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $user['email'] = $mysqli->real_escape_string($_POST["email"]);
    } else {
        $error[]= "Invalid email format.";
    }
    //password
    if (isset($_POST["password"]) && preg_match('/^[A-Za-z0-9]{5,20}$/', $_POST["password"])) {
        $password = $mysqli->real_escape_string($_POST["password"]);
        $user['hpassowrd'] = hash('sha512', $password);
    } else {
        $error [] = 'Password must be between 5 and 20 characters long and contain only letters and numbers.';
    }
    if ($_POST["password"] !== $_POST["conf_password"]) {
        $error[]= 'Passwords do not match.';
    }

    if (empty($error)) {
        $query_insert_user = "INSERT INTO users(username,password,email,activated,token,c_token)
VALUES('{$user['username']}','{$user['hpassowrd']}','{$user['email']}',{$user['activated']},'{$user['token']}','{$user['c_token']}')";
        $mysqli->query($query_insert_user);
        $user['id'] = $mysqli->insert_id;
        $subject = "Register";
        $message = "Activation link has been sent to your email.";
        $body = '<a href="' . SITE . 'register?token=' . $user['token'] . '&email=' . $user['email'] . '&id=' . $user['id'] . '" target="_blank">Activation link.</a>';
        send_ver($user['email'], $subject, $message, $body);
    } else {
        $smarty->assign("user",$user);
        $smarty->assign('error', $error);
    }
}
$display = "register_form";





