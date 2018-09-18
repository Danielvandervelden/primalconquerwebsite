<?php 
get_header();

require 'database/db.php';
session_start();

$loggedin = $_SESSION['logged-in'];
$username = $_SESSION['username'];

$donation = floor($_SESSION['donate']);

$mysqli->query($addtable);

$result = $mysqli->query("SELECT * FROM accounts WHERE username='$username'");
$user = $result->fetch_assoc();
$currentCPs = $user['CPs'];

$totalDonation = $currentCPs + $donation;

$changeCPs = $mysqli->query("UPDATE accounts SET CPs = '$totalDonation' WHERE username = '$username'")


?>

<div class="main-content-container"> 
    <div class="padding-top padding-bottom padding-left padding-right white">
        <?php if($loggedin && $donation !== false) {?>
        Thank you for your donation, <?php echo $username ?>. Please relog your account and check your inventory! The amount of money you donated should be converted into CPS!
        <?php } else if ($donation === false || $loggedin === false) { ?>
        Getting free CPs without donating... don't we all want that?
        <?php } ?>
    </div>
</div>

<?php get_footer(); ?>