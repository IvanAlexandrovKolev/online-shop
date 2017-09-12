<?php
session_start();

require_once( 'php-graph-sdk-5.0.0/src/Facebook/autoload.php' );

$fb = new Facebook\Facebook([
    'app_id' => '1274582045910660',
    'app_secret' => 'cba30ab19e137a52942b24c72f256840',
    'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions for more permission you need to send your application for review
$loginUrl = $helper->getLoginUrl('http://localhost/register/callback.php', $permissions);
header("location: ".$loginUrl);

?>