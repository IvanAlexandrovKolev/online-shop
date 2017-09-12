<?php
if(isset($_SESSION)){
    unset($_COOKIE['token']);
    setcookie('token', null, -1, '/');
    session_unset();
    session_destroy();
    header("Location: login");
}
include_once ("login.php");

