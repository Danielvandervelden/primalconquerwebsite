<?php

//Load Composer's autoloader
require 'vendor/autoload.php';
require 'db.php';

$userEmail = $_POST['email'];
$username = $_POST['username'];
$websiteUrl = site_url();
$result = $mysqli->query("SELECT * FROM accounts WHERE username='$username'");
$user = $result->fetch_assoc();

$userHash = $user['Hash'];

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port =  587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "PrimalConquer@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "ThisIsPrimal1234";
//Set who the message is to be sent from
$mail->setFrom('PrimalConquer@gmail.com', 'Primal Conquer');
//Set an alternative reply-to address
$mail->addReplyTo('PrimalConquer@gmail.com', 'Primal Conquer');
//Set who the message is to be sent to
$mail->addAddress($userEmail, $username);
//Set the subject line
$mail->Subject = 'PrimalCO Password Reset';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->Body = "<div>
    Hello there <?php $username ?>!
    You're receiving this email, because you've requested to reset your password. Please click on the following link to reset it:
    $websiteUrl/reset-password?username=$username&hash=$userHash</div>"; 
//Replace the plain text body with one created manually
$mail->AltBody = 'This is just a simple test email.';
//send the message, check for errors

if($user['Email'] === $userEmail) {

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message success flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>If the username and email match, an email will be sent to you!</p></div></div>";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
} else { 
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message success flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>If the username and email match, an email will be sent to you!</p></div></div>";
 } ?>
