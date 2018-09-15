<?php 
require 'vendor/autoload.php';

define('SITE_URL', 'http://primalconquer.com.test');

$clientID = 'ATShcGVgsH1xyn04dH_bT0Bbe9D0gBx6fVq012aY4EBe9SCj4G_hFNJcAz-3Kzjo02NF6QCyylmJq_bb';
$secretID = 'EFUXUn2E2OjU3F9sYu1U8mVn7u8a06I2WUg4GNlqEhtOA3lZgR0tD9AdqGl6qAq5G1iuG-Y3L2PezDY7';

$paypal = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $clientID,
        $secretID
        )
    );

