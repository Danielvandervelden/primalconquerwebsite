<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

$_SESSION['username'] = $_POST['register_username'];
$_SESSION['password'] = $_POST['register_password'];
$_SESSION['email'] = $_POST['register_email'];
$_SESSION['question'] = $_POST['register_question'];
$_SESSION['answer'] = $_POST['register_answer'];
$_SESSION['securitycode'] = $_POST['register_securitycode'];

$username = $mysqli->escape_string($_POST['register_username']);
$email = $mysqli->escape_string($_POST['register_email']);
$question = $mysqli->escape_string($_POST['register_question']);
$answer = $mysqli->escape_string($_POST['register_answer']);
$security_code = $mysqli->escape_string($_POST['register_securitycode']);
$password = $mysqli->escape_string($_POST['register_password']);
$password2 = $mysqli->escape_string($_POST['register_password2']);
$security = $mysqli->escape_string($_POST['register_security']);
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
  echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Error!</p></div></div>";
} else if (empty($question) || empty($answer) || empty($security_code) || empty($username) || empty($password) || empty($password2) || empty($email)) {
  echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Please fill in all the fields!</p></div></div>";
} else if($result->num_rows > 0) {
  echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>User with this username already exists!</p></div></div>";

  } elseif ($password === $password2){
    $addtable = "ALTER TABLE  `accounts` ADD  `Hash` VARCHAR(100) NOT NULL";

    $mysqli->query($addtable);

    $sql = "INSERT INTO accounts (Username,Password,Email,SecurityQuestion,SecurityAnswer,SecurityCode,Authority,Hash)" 
            . "VALUES('$username','$password','$email','$question','$answer','$security_code','$authority','$hash')";

            if($mysqli->query($sql)) {
              echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message success flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Registration successfull!</p></div></div>";

            } else {
              echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Something went wrong!</p></div></div>";
            }
  } else {
  echo "<div class='full-opacity faded-black-bg notice flex align-center j-center'><div class='message error flex-40'><i class='fa fa-window-close' aria-hidden='true'></i><p>Passwords don't match!</p></div></div>";
  }