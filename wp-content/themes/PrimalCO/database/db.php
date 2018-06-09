<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'primaldb';
$Server = 'PrimalConquer';
$WorldPort = '5818';
$loginPort = '9958';

$mysqli = new mysqli($host,$user,$pass,$db) or die ($mysqli->error);