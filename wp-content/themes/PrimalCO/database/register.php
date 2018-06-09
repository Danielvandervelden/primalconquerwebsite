<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['question'] = $_POST['question'];
$_SESSION['answer'] = $_POST['answer'];
$_SESSION['securitycode'] = $_POST['securitycode'];

$username = $mysqli->escape_string($_POST['username']);
$email = $mysqli->escape_string($_POST['email']);
$question = $mysqli->escape_string($_POST['question']);
$answer = $mysqli->escape_string($_POST['answer']);
$security_code = $mysqli->escape_string($_POST['securitycode']);
$password = $mysqli->escape_string($_POST['password']);
$password2 = $mysqli->escape_string($_POST['password2']);
$security = $mysqli->escape_string($_POST['security']);
$authority = 0;

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

$hash = randomString();


$result = $mysqli->query("SELECT * FROM accounts WHERE username='$username'") or die ($mysqli->error());

if(!empty($security)) {
  echo "<div class='message error'><p>Error!</p></div>";
} else if($result->num_rows > 0) {
  echo "<div class='message error'><p>User with this username already exists!</p></div>";

  } elseif ($password === $password2){
    $addtable = "ALTER TABLE  `accounts` ADD  `Hash` VARCHAR(100) NOT NULL";

    $mysqli->query($addtable);

    $sql = "INSERT INTO accounts (Username,Password,Email,SecurityQuestion,SecurityAnswer,SecurityCode,Authority,Hash)" 
            . "VALUES('$username','$password','$email','$question','$answer','$security_code','$authority','$hash')";

            if($mysqli->query($sql)) {
              echo "<div class='message success'><p>Registration successfull!</p></div>";

            } else {
              echo "<div class='message error'><p>Something went wrong!</p></div>";
            }
  } else {
  echo "<div class='message error'><p>Passwords don't match!</p></div>";
  }