<?php
/* User login process, checks if user exists and password is correct */
$username = $mysqli->escape_string($_POST['username']);
$result = $mysqli->query("SELECT * FROM accounts WHERE username='$username'");

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

if($result->num_rows == 0) {//if user doesn't exist.. 

    echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>User with that username does not exist</p></div></div>";

} else { // user exists
    $user = $result->fetch_assoc();

    if($_POST['password'] === $user['Password']) { //if the passwords match, log 'em in
        if($user['Hash'] === "") {
            $addtable = "ALTER TABLE  `accounts` ADD  `Hash` VARCHAR(100) NOT NULL";
            $hash = randomString();
            $sql = "UPDATE accounts SET Hash='$hash' WHERE Username='$username'";
            $mysqli->query($sql);
        }
        
        $_SESSION['username'] = $user['Username'];
        $_SESSION['hash'] = $user['Hash'];

        $_SESSION['logged-in'] = true;
    } else {
        echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>WRONG PASSWORD BRAH</p></div></div>";
    }
}