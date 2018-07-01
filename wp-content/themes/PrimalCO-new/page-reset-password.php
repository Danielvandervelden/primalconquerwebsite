<?php 
get_header();
require 'database/db.php';
session_start();

$usernameParam = $_GET['username'];
$userHashParam = $_GET['hash'];
$_SESSION["usernameParam"] = $usernameParam;

$result = $mysqli->query("SELECT * FROM accounts WHERE username='$usernameParam'");
$user = $result->fetch_assoc();

$usernameDb = $user['Email'];
$userHashDb = $user['Hash'];

if($userHashParam === $userHashDb ) {

if( isset($_GET['username']) && !empty($_GET['username']) AND isset($_GET['hash']) && !empty($_GET['hash']) ) {?>

<div class="main-content-container rules">
    <main>
        <div class="parallax-container" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">

        <div class="form-wrapper margin-center padding-top">
        <h2 class="white hl center">Reset your password</h2>
             <form method="post" action=<?php echo site_url('/support') ?>>

            <div class="form-group" style="display: none">
                <label for="username">Username</label>
                <input readonly class="form-control" name="username" type="text" placeholder="Enter your current username." value=<?php echo $usernameParam ?>>
            </div>

            <div class="form-group">
                <label class="white hm" for="password">New Password</label>
                <input name="new-password" class="form-control" type="password" placeholder="Enter you new password">
            </div>

            <div class="form-group">
                <label class="white hm" for="password">Re-enter New Password</label>
                <input name="new-password2" class="form-control" type="password" placeholder="Confirm your new password" value="<?php echo $email ?>">
            </div>

            <button name="password_change_email" type="submit" class="btn btn-primary">Change Password</button>
        </form>
</div>
        </div>
    </main>
</div>

<?php } else {

    echo "<div class='message error'>There's something fishy going on, try again...</div>";
} 
} else { echo "Something went terribly wrong.. Try requesting a new password again."; }?>
<?php 
get_footer();
?>