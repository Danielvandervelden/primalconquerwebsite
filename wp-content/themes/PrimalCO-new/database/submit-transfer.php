<?php 

require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$server = $_POST['server'];
$uid = $_SESSION['uid'];
$status = 0;
$loggedIn = $_SESSION['logged-in'];

if($loggedIn && $uid !== NULL) {
    $sql = "INSERT INTO transfer (UID,Username,Password,Server,Status)" 
            . "VALUES('$uid','$username','$password','$server','$status')";

        if($mysqli->query($sql)) {
            echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message success flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Our staff has gotten your information. We will verify if you are eligible for a transfer!</p></div></div>";

            } else {
                var_dump($sql);
            echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Something went wrong!</p></div></div>";
            }
} else {
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Something was not set correctly. Please relogin and try again!</p></div></div>";
}
