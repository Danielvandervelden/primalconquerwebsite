<?php

$username = $_SESSION['username'];
$result = $mysqli->query("SELECT * FROM accounts WHERE username='$username'");
$user = $result->fetch_assoc();
$passwordDatabase = $user['Password'];

$usernameForm = $mysqli->escape_string($_POST['username']);
$password = $mysqli->escape_string($_POST['current-password-form']);
$newPassword = $mysqli->escape_string($_POST['new-password']);
$newPassword2 = $mysqli->escape_string($_POST['new-password2']);

if ($password !== $passwordDatabase) {
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>The current password you entered is wrong!</p></div></div>";
} else if ($newPassword !== $newPassword2) {
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Your new passwords don't match!</p></div></div>";
} else if ($usernameForm !== $username) {
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Your username is incorrect!</p></div></div>";
} else {

    $sql = "UPDATE accounts SET Password='$newPassword' WHERE Username='$usernameForm'";

    if (mysqli_query($mysqli, $sql)) {
        echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message success flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Your password has been changed!</p></div></div>";
    } else {
        echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Failed for some reason</p></div></div>";
    }

}
