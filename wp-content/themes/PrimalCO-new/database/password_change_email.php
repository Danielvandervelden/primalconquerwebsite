<?php

$username = $mysqli->escape_string($_POST['username']);
$newPassword = $mysqli->escape_string($_POST['new-password']);
$newPassword2 = $mysqli->escape_string($_POST['new-password2']);

function randomString($length = 20) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

if ($newPassword !== $newPassword2) {
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Your new passwords don't match!</p></div></div>";
} else if($_SESSION["usernameParam"] !== $username) { 
    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Sorry, but you failed to fuck with us :)</p></div></div>";

} else {

    $sql = "UPDATE accounts SET Password='$newPassword' WHERE Username='$username'";
    $hash = randomString();
    $changehash = "UPDATE accounts SET Hash='$hash' WHERE Username='$username'";

    mysqli_query($mysqli, $changehash);

    if (mysqli_query($mysqli, $sql)) {
        echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message success flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Your password has been changed!</p></div></div>";
    } else {
        echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Failed for some reason</p></div></div>";
    }

}
