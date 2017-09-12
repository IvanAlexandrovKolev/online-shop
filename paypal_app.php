<?php
require_once ("vendor/autoload.php");
require_once ("config.php");
session_start();
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$paypal = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AVv7nG8WxN1zlljTpQY10RlzMPzUXVB2c4gM7wg1uBDPOd15vLsq2v3rqCtvYnWJ9FiuLc5wJKwPRswP',
        'ECU9SrNGFd8E__WqkXe9g00DBGSjXS6g4Xdv7H3hz3JbMgIlyAUleOp3DLAfA8RvY0lCgjFM9U_GRIXl'
    )
);
$payer = new Payer();
$payer->setPaymentMethod('paypal');

$itemList = new ItemList();
$itemList->setItems($items);

$details = new Details();
$details->setShipping(0)
    ->setTax(0)
    ->setSubtotal($total);

$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal($total)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE."ExecutePayment.php?success=true&total={$total}")
    ->setCancelUrl(SITE."ExecutePayment.php?success=false");

$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

$request = clone $payment;





try {
    $payment->create($paypal);
    $paypal_data = json_decode($payment,true);

    $insert_sql = "INSERT INTO pending_paypal_orders(paypal_id,order_token)
                   VALUES ('{$paypal_data['id']}','{$data['order_token']}')";
    $mysqli->query($insert_sql);

    
} catch (Exception $ex) {
    ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
    exit(1);
}
$approvalUrl = $payment->getApprovalLink();
header("Location: {$approvalUrl}");
//return $payment;


