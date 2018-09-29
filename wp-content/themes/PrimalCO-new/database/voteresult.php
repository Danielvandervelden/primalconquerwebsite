<?php

/*
Template Name: voteresult
*/

$token = $_GET['custom'];

require 'db.php';

$result = $mysqli->query("SELECT * FROM accounts WHERE Token='$token'");
$user = $result->fetch_assoc();

$username = $user['Username'];

$lastVote = $user['LastVote'];
$allowedVote = date('Y-m-d H:i:s',strtotime('+12 hour',strtotime($lastVote)));

$tz = 'Europe/London';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$currentTime = $dt->format('Y-m-d H:i:s');

if($allowedVote < $currentTime) {
    $currentVotePoints = $user['VotePoints'];
    $newVotePoints = $currentVotePoints + 1;

    $updateVotePoints = $mysqli->query("UPDATE accounts SET VotePoints = '$newVotePoints' WHERE Username = '$username'");
    $updateLastVoted = $mysqli->query("UPDATE accounts SET LastVote = '$currentTime' WHERE Username = '$username'");
 }
