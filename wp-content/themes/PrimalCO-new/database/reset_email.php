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
    echo "<div class='message from-top error'>
            <p>The current email you entered is wrong!</p>
        </div>";
} else if ($usernameForm !== $username) {
    echo "<div class='message from-top error'>
            <p>Your username is incorrect!</p>
        </div>";
} else if ($password !== $user['Password']) {
    echo "<div class='message from-top error'>
            <p>Your password is incorrect!</p>
        </div>";
} else {

    $sql = "UPDATE accounts SET Email='$newEmail' WHERE Username='$usernameForm'";

    if (mysqli_query($mysqli, $sql)) {
        echo "<div class='message from-top success'>
        <p>Your email has been changed!</p>
    </div>";
    } else {
        echo "<div class='message from-top error'><p>Failed for some reason</p></div>";
    }

}
