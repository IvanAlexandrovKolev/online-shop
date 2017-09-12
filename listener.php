<?php
require ('PaypalIPN.php');

include_once "database.php";
//use PaypalIPN;
$ipn = new PaypalIPN();
$mysqli->query("INSERT INTO test(text,num) VALUES('dotuk',1)");
try {
    $ipn->useSandbox();
    $verified = $ipn->verifyIPN();
} catch(Exception $e) {
    $mysqli->query("INSERT INTO test(text,num) VALUES('greshka',3)");
}

if ($verified) {
    $resp = "SUCCESS";
    $mysqli->query("INSERT INTO test(text,num) VALUES('{$resp}',2)");
}
$mysqli->query("INSERT INTO test(text,num) VALUES('dotuk',3)");
// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");

?>
