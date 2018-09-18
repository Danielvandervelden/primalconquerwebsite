<?php
session_start();
$donation = $_POST['donation'];
$_SESSION['donate'] = $donation;

echo $donation;