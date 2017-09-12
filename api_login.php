<?php


$data = [];
$error= [];
$response = [];
$request_data = json_decode($_POST["request"],true);
$app_sql = "SELECT * FROM app_id_secret 
            WHERE app_id = '{$request_data["app_id"]}'";
$app = $mysqli->query($app_sql);
$app = $app->fetch_assoc();
$appSecret = $app["app_secret"];

$user_sql = "SELECT username,password,email,token,c_token,admin FROM users 
             WHERE username = '{$request_data["username"]}' AND password = '{$request_data["password"]}' AND activated=1";
$get_user = $mysqli ->query($user_sql);
$user = $get_user->fetch_assoc();

if($user) {
    $data["username"] = $user["username"];
    $data["password"] = $user["password"];
    $data["request_time"] = $request_data["request_time"];
    $data["app_id"] = $request_data["app_id"];
    $data["access_token"] = my_hash($data, $appSecret);
}
if(isset($data["access_token"]) && $request_data["access_token"] === $data["access_token"]) {
    $response["success"] = $user;
} else {
    $error[] = "Invalid username or password";
    $response["fail"] = $error;
}
$response = json_encode($response);
//$response = "asdasdsadsadassad";
echo $response;
die;


function my_hash($data,$appSecret){
    $str = $data["app_id"] . "|";
    foreach($data as $k=>$v){
        if(!empty($k) && !empty($v) && !is_array($v)){
            $str .= "{$k}:{$v}|";
        }
    }
    $str .= $appSecret;
    return sha1($str);
}
?>