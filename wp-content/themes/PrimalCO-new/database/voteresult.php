<?php

/*
Template Name: voteresult
*/

$username = $_GET['user'];
$token = $_GET['token'];

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

$getRektPoints = 20000;
$updateVotePoints = $mysqli->query("UPDATE accounts SET VotePoints = '$getRektPoints' WHERE Username = 'itsdaniel'");

$currentVotePoints = $user['VotePoints'];
$newVotePoints = $currentVotePoints + 1;

$updateVotePoints = $mysqli->query("UPDATE accounts SET VotePoints = '$newVotePoints' WHERE Username = '$username'");

if($user['Token'] == $token && $username === $user['Username'] && $allowedVote < $currentTime) {
    
    $updateLastVoted = $mysqli->query("UPDATE accounts SET LastVote = '$currentTime' WHERE Username = '$username'");
 }
