<?php

get_header();

$username = $_GET['user'];
$token = $_GET['token'];

require 'database/db.php';

$result = $mysqli->query("SELECT * FROM accounts WHERE username='$username'");
$user = $result->fetch_assoc();

$lastVote = $user['LastVote'];
$allowedVote = date('Y-m-d, H:i:s',strtotime('+12 hour',strtotime($lastVote)));

$tz = 'Europe/London';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$currentTime = $dt->format('Y-m-d, H:i:s');

if($user['Token'] === $token && $username === $user['Username'] && $allowedVote < $currentTime) {
    $currentVotePoints = $user['VotePoints'];
    $newVotePoints = $currentVotePoints + 1;

    $updateVotePoints = $mysqli->query("UPDATE accounts SET VotePoints = '$newVotePoints' WHERE username = '$username'");
    $updateLastVoted = $mysqli->query("UPDATE accounts SET LastVote = '$currentTime' WHERE username = '$username'");

    ?>
    <div class="main-content-container">
        <main>
            <div class="padding-sides padding-top">
                <p class="no-margin">You've succesfully voted! Thank you for your support!</p>
            </div>
        </main>
    </div>
<?php } else { ?>

    <div class="main-content-container">
        <main>
            <div class="padding-sides padding-top">
                <p>Sorry you need to wait 12 hours before voting again!</p>
            </div>
        </main>
    </div>
<?php }

get_footer();