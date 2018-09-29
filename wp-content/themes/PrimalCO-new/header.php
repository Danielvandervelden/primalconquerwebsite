<?php 
require 'database/db.php';
session_start();
$accountLink;
$logged_in = $_SESSION['logged-in'];
$username = $_SESSION['username'];
$token = $_SESSION['token'];

$result = $mysqli->query("SELECT * FROM accounts WHERE username='$username'");
$user = $result->fetch_assoc();

    if (isset($_POST['login'])) { // if the login button gets clicked
        require 'database/login.php';
    } elseif (isset($_POST['register'])) { // if the register button gets clicked
        require 'database/register.php';
    } elseif (isset($_POST['logout'])) { // if the logout button gets clicked
        require 'database/logout.php';
    } elseif (isset($_POST['password_change'])) { // if change password button gets clicked
        require 'database/reset_password.php';
    } elseif (isset($_POST['email_change'])) { // if change email button gets clicked
        require 'database/reset_email.php';
    } elseif (isset($_POST['forgot_password'])) { // if change email button gets clicked
        require 'database/forgot-password.php';
    } elseif (isset($_POST['password_change_email'])) { // if change email button gets clicked
        require 'database/password_change_email.php';
    } elseif (isset($_POST['submit-support'])) { // if change email button gets clicked
        require 'database/submit_support.php';
    } elseif (isset($_POST['submit_donation'])) { // if you submit your donation gets clicked
        require 'paypal/submit-donation.php';
    }

if($logged_in) {
    $accountLink = site_url('/profile');
} else {
    $accountLink = site_url('/account');
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="Rl_KK5vG4-rHG-3Vihro0sMxRz6j8h6IAZxHj23rNTU" />
    <title>PrimalCO</title>
</head>

<body <?php body_class() ?>>
    <div class="website-container">
        <header class="header-container clearfix flex flex-column relative">
            <div id="mobile-menu">
                <i class="open-menu fa fa-bars"></i>
                <div class="mobile-menu-content">
                <i class="close-menu fa fa-times"></i>
                </div>
            </div>
            <div class="header-v-center absolute">
            <div class="no-opacity full-opacity-animation relative flex-100 logo center">
                <img src="<?php echo get_theme_file_uri('./assets/images/logo.png') ?>" alt="Primal Conquer Logo">
            </div>
            <nav class="flex-100 menu relative">
                <ul class="main-menu margin-center absolute flex evenly">
                    <li class="flex-20 main-menu-item center">
                        <a class="home" href="<?php echo site_url('/home') ?>">Home</a>
                    </li>
                    <li class="flex-20 main-menu-item center">
                        <a class="account" href="<?php echo site_url('/account') ?>">Register</a>
                    </li>
                    <li class="flex-20 main-menu-item has-children dropdown center">
                        <a class="server" href="#">Server</a>
                        <ul class="inner-menu faded-black-bg">
                             <li class="inner-menu-item">
                                <a href="<?php echo site_url('/news') ?>">News</a>
                            </li>
                            <li class="inner-menu-item">
                                <a href="<?php echo site_url('/downloads') ?>">Downloads</a>
                            </li>
                            <li class="inner-menu-item">
                                <a href="<?php echo site_url('/rules') ?>">Rules</a>
                            </li>
                        </ul>
                    </li>
                    <li class="flex-20 main-menu-item center">
                        <a class="support" href="<?php echo site_url('/support') ?>">Support</a>
                    </li>
        <?php if (!$_SESSION['logged-in']) {?>
                    <li class="flex-20 main-menu-item has-children dropdown center">
                        <a href="#">Login</a>
                        <ul class="inner-menu login faded-black-bg">
                            <div class="form-wrapper">
                                <form method="post" action="<?php echo site_url() ?>">
                                    <div>
                                        <input name="username" type="text" placeholder="Username">
                                    </div>
                                    <div>
                                        <input name="password" type="password" placeholder="Password">
                                    </div>

                                    <button name="login" class="btn btn-block" type="submit">Login</button><a class="center" href="<?php echo site_url('/forgot') ?>">Forgot password</a>
                                </form>
                            </div>
                        </ul>
                    </li>
                    <?php } else {?>
                    <li class="flex-20 main-menu-item has-children dropdown center">
                        <a class="profile" href="#" ><i class="fas fa-user"></i></a>
                        <ul class="inner-menu faded-black-bg">
                            <a class="inner-menu-item" href="<?php echo site_url('/profile') ?>">My Profile</a>
                            <a class="inner-menu-item" href="<?php echo site_url('/donate') ?>">Donate</a>
                            <form action="/" method="POST">
                            <button class="btn" name="logout" type="submit">Logout</button>
                            </form>
                        </ul>
                    </li>
                    <?php }?>
                </ul>
            </nav>
            </div>
            
            <?php if($username) : ?>
            <div class="xtremetop100">
                <h2 class="white">Vote for us!</h2>
                <a href='<?php echo "http://www.xtremetop100.com/in.php?site=1132324901&custom=" . $token ?>'>
                <img src="/wp-content/themes/PrimalCO-new/assets/images/votenew.jpg" alt="private server"></a>
            </div>
            <?php endif; ?>     
        </header>