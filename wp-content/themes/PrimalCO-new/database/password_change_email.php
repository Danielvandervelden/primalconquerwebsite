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
    echo "<div class='message error'>
            <p>Your new passwords don't match!</p>
        </div>";
} else if($_SESSION["usernameParam"] !== $username) { 
    echo "<div class='message error'>
            <p>Sorry, but you failed to fuck with us :)</p>
        </div>";

} else {

    $sql = "UPDATE accounts SET Password='$newPassword' WHERE Username='$username'";
    $hash = randomString();
    $changehash = "UPDATE accounts SET Hash='$hash' WHERE Username='$username'";

    mysqli_query($mysqli, $changehash);

    if (mysqli_query($mysqli, $sql)) {
        echo "<div class='message success'>
        <p>Your password has been changed!</p>
    </div>";
    } else {
        echo "<div class='message error'><p>Failed for some reason</p></div>";
    }

}
