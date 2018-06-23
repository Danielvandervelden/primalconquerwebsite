<?php

$username = $_SESSION['username'];
$result = $mysqli->query("SELECT * FROM accounts WHERE username='$username'");
$user = $result->fetch_assoc();
$emailDatabase = $user['Email'];

$usernameForm = $mysqli->escape_string($_POST['username']);
$currentEmail = $mysqli->escape_string($_POST['current-email-form']);
$newEmail = $mysqli->escape_string($_POST['new-email']);
$password = $mysqli->escape_string($_POST['password']);

if ($currentEmail !== $emailDatabase) {
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>The current email you entered is wrong!</p></div></div>";
} else if ($usernameForm !== $username) {
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Your username is incorrect!</p></div></div>";
} else if ($password !== $user['Password']) {
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Your password is incorrect!</p></div></div>";
} else {

    $sql = "UPDATE accounts SET Email='$newEmail' WHERE Username='$usernameForm'";

    if (mysqli_query($mysqli, $sql)) {
        echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message success flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Your email has been changed!</p></div></div>";
    } else {
        echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Failed for some reason</p></div></div>";
    }

}
