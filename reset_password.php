<?php

if (isset($_GET["token"])) {
    $token = $mysqli->real_escape_string($_GET["token"]);
    $user_query = "SELECT * FROM users WHERE token = '{$token}'";
    $get_user = $mysqli->query($user_query);
    $user = $get_user->fetch_assoc();
    if(!empty($user)){
        if (isset($_POST['pass']) && isset($_POST["conf_pass"])) {
            $password = $mysqli->real_escape_string($_POST["pass"]);
            $conf_pass = $_POST["conf_pass"];
            $hpassword = hash('sha512', $_POST['pass']);
            $error = [];
            if (preg_match('/^[A-Za-z0-9]{5,20}$/', $password)) {
                if ($password != $conf_pass) {
                    $error[] = "Passwords don't match";
                }
            } else {
                $error[] = 'Password must be between 5 and 20 characters long and contain only letters and numbers.';
            }
            if (empty($error)) {
                $update_user_password_query = "UPDATE `users` SET password = '{$hpassword}' WHERE `id`={$user['id']}";
                $mysqli->query($update_user_password_query);
                $_SESSION['message'] = "New password set.You can now enter your account";
                header("Location: " . SITE . "login");
            } else {
                $smarty->assign('error', $error);
            }
        }
    } else {
        $er_message = "Such user doesn't exist";
        $_SESSION['er_message'] = $er_message;
        header("Location: " . SITE . "products");
        die;
    }
    $label = "Reset password";
    $php_file = "reset_password";
    $smarty->assign("label",$label);

    $display = "reset_password_form";
}
if (isset($_POST['email']) && isset($_POST['username'])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $query_check_user = "SELECT * FROM users WHERE username = '{$username}' AND email = '{$email}'";
    $check_user = $mysqli->query($query_check_user);
    if ($mysqli->affected_rows == 1) {
        $user = $check_user->fetch_assoc();
        $token = $user['token'];
        $subject = "Forgot password";
        $message = "Confirmation link has been sent to your email";
        $body = '<a href="' . SITE . 'reset_password?token=' . $token . '" target="_blank">Reset password.</a>';
        send_ver($email, $subject, $message, $body);
        session_start();
        $_SESSION['message'] = "Confirmation link has been sent to your email";
        header("Location: " . SITE . "login");
        die;
    } else {
        $smarty->assign('error', "Invalid username or password");
    }
}


