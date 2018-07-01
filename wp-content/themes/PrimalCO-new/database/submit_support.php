<?php

//Load Composer's autoloader
require 'vendor/autoload.php';
require 'db.php';

$supportName = $mysqli->escape_string($_POST['support_name']);
$supportEmail = $mysqli->escape_string($_POST['support_email']);
$supportSubject = $mysqli->escape_string($_POST['support_subject']);
$supportMessage = $mysqli->escape_string($_POST['support_message']);
$security = $mysqli->escape_string($_POST['support_security']);


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
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "PrimalConquer@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "PrimalConquer2k18";
//Set who the message is to be sent from
$mail->setFrom($supportEmail, $supportName);
//Set an alternative reply-to address
$mail->addReplyTo($supportEmail, $supportName);
//Set who the message is to be sent to
$mail->addAddress('PrimalConquer@gmail.com', 'PrimalConquer');
//Set the subject line
$mail->Subject = $supportSubject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->Body = "FROM: $supportEmail NAME: $supportName MESSAGE: $supportMessage";


//Replace the plain text body with one created manually
$mail->AltBody = "FROM: $supportEmail NAME: $supportName MESSAGE: $supportMessage";
//send the message, check for errors

if(!empty($security)) {
  echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Error!</p></div></div>";
} else {
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message success flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Your support message has been sent!</p></div></div>";
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    } 
}
