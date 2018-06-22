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
    echo "<div class='message from-top error'>
            <p>The current password you entered is wrong!</p>
        </div>";
} else if ($newPassword !== $newPassword2) {
    echo "<div class='message from-top error'>
            <p>Your new passwords don't match!</p>
        </div>";
} else if ($usernameForm !== $username) {
    echo "<div class='message from-top error'>
            <p>Your username is incorrect!</p>
        </div>";
} else {

    $sql = "UPDATE accounts SET Password='$newPassword' WHERE Username='$usernameForm'";

    if (mysqli_query($mysqli, $sql)) {
        echo "<div class='message from-top success'>
        <p>Your password has been changed!</p>
    </div>";
    } else {
        echo "<div class='message from-top error'><p>Failed for some reason</p></div>";
    }

}
