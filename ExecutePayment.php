<?php

require_once ("vendor/autoload.php");
require_once ("config.php");
require_once ("database.php");

require_once ("vendor/paypal/rest-api-sdk-php/sample/common.php");

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

session_start();

$paypal = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AVv7nG8WxN1zlljTpQY10RlzMPzUXVB2c4gM7wg1uBDPOd15vLsq2v3rqCtvYnWJ9FiuLc5wJKwPRswP',
        'ECU9SrNGFd8E__WqkXe9g00DBGSjXS6g4Xdv7H3hz3JbMgIlyAUleOp3DLAfA8RvY0lCgjFM9U_GRIXl'
    )
);

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $total = $_GET['total'];
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $paypal);

    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    $transaction = new Transaction();
    $amount = new Amount();
    $details = new Details();

    $details->setShipping(0)
        ->setTax(0)
        ->setSubtotal($total);

    $amount->setCurrency('USD');
    $amount->setTotal($total);
    $amount->setDetails($details);
    $transaction->setAmount($amount);

    $execution->addTransaction($transaction);
    try {
        $result = $payment->execute($execution, $paypal);
        try {
            $payment = Payment::get($paymentId, $paypal);
        } catch (Exception $ex) {
            exit(1);
        }
    }catch (Exception $ex) {
        exit(1);
    }
    $payer_site_id = $_SESSION["token"];
    $payment = json_decode($payment,true);

    $insert_sql = "INSERT INTO paypal_orders(paypal_id,payer_name,payer_paypal_id,payer_site_token,total) 
                   VALUES (
                   '{$payment['id']}',
                   '{$payment['payer']['payer_info']['shipping_address']['recipient_name']}',
                   '{$payment['payer']['payer_info']['payer_id']}',
                   '$payer_site_id',
                   $total)";
    $mysqli->query($insert_sql);

    $_SESSION['message'] = "Products bought successfully!";
    header("Location: " . SITE . "products");
}else {
    ResultPrinter::printResult("User Cancelled the Approval", null);
    exit;
}