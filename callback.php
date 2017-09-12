<?php

session_start();
require_once( 'php-graph-sdk-5.0.0/src/Facebook/autoload.php' );
require_once( 'config.php' );
require_once('database.php');


$fb = new Facebook\Facebook([
    'app_id' => '1274582045910660',
    'app_secret' => 'cba30ab19e137a52942b24c72f256840',
    'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

try {
    $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken->getValue());
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'ERROR: Graph ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'ERROR: validation fails ' . $e->getMessage();
    exit;
}
$me = $response->getGraphUser();
$user = [];
$user["fb_username"] = $me["name"];
$user["fb_email"] = $me["email"];
$user_sql = "SELECT username,password,email,token,c_token,admin FROM users 
             WHERE username = '{$user["fb_username"]}' AND email = '{$user["fb_email"]}' AND activated = 1";
$get_user = $mysqli->query($user_sql);
$my_user = $get_user->fetch_assoc();

if($my_user){
    $_SESSION = $my_user;
    header("Location: " . SITE . "products");
} else {
    $_SESSION = $user;
    header("Location: " . SITE . "register_fb");
}
?>