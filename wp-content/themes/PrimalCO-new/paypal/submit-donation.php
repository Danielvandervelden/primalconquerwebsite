<?php 
require 'init.php';
require 'vendor/autoload.php';

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;

if(!isset($_POST['donation_amount'], $_POST['character'])) {
    die();
}

$amount = $_POST['donation_amount'];

$character = $_POST['character'];

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setName($donationAmount)
    ->setCurrency('EUR')
    ->setQuantity(1)
    ->setPrice($amount);
    
$itemList = new ItemList();
$itemList->setItems([$cps]);

$amount = new Amount();
$amount->setCurrency('EUR')
    ->setTotal((int)$amount);

$transation = new Transaction();
$transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Pay for CPs')
            ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL . '/pay?success=true')
            ->setCancelUrl(SITE_URL . '/pay?success=false');

$payment = new Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);