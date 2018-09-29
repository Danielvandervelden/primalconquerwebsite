<?php

/*
Template Name: voteresult
*/

$username = 'itsdaniel';
$token = 151;

require 'db.php';

$result = $mysqli->query("SELECT * FROM accounts WHERE Username='$username'");
$user = $result->fetch_assoc();

$lastVote = $user['LastVote'];
$allowedVote = date('Y-m-d H:i:s',strtotime('+12 hour',strtotime($lastVote)));

$tz = 'Europe/London';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$currentTime = $dt->format('Y-m-d H:i:s');

$newVotePoints = 1000;
$updateVotePoints = $mysqli->query("UPDATE accounts SET VotePoints = '$newVotePoints' WHERE username = '$username'");

echo 'executed';

var_dump($user['name'], $user['token'], $user);

if($user['Token'] == $token && $username === $user['Username'] && $allowedVote < $currentTime) {
    $currentVotePoints = $user['VotePoints'];
    $newVotePoints = $currentVotePoints + 1;

    // $updateVotePoints = $mysqli->query("UPDATE accounts SET VotePoints = '$newVotePoints' WHERE username = '$username'");
    // $updateLastVoted = $mysqli->query("UPDATE accounts SET LastVote = '$currentTime' WHERE username = '$username'");

    echo 'win';
 }
