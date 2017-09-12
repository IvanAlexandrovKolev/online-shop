<?php
if (isset($_POST['pass']) && isset($_POST["conf_pass"])) {
    print_r($_POST);
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
        $user = [];
        $user["username"] = $_SESSION["fb_username"];
        $user["email"] = $_SESSION["fb_email"];
        $user["hpassword"] = $hpassword;
        $user['token'] = getToken(10);
        $user['admin'] = 0;
        $user['c_token'] = $_COOKIE['token'];

        $insert_user_sql = "INSERT INTO users(username,password,email,activated,token,c_token)
                            VALUES('{$user['username']}','{$user['hpassword']}','{$user['email']}',1,'{$user['token']}','{$user['c_token']}')";
        $mysqli->query($insert_user_sql);
        unset($user["hpassword"]);
        unset($_COOKIE["token"]);
        $_SESSION = $user;
        $_SESSION['message'] = "New account created.";
        header("Location: " . SITE . "products");
    }
}
$label = "Set password";
$php_file = "register_fb";
$smarty->assign("label",$label);
$smarty->assign("php_file",$php_file);
$display = "reset_password_form";

?>