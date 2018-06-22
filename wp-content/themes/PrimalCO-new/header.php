<?php 
require 'database/db.php';
session_start();
$accountLink;
$logged_in = $_SESSION['logged-in'];

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
    <title>PrimalCO</title>
</head>

<body <?php body_class() ?>>
    <div class="website-container">
        <header class="header-container clearfix flex flex-column relative">
            <div class="header-v-center absolute">
            <div class="relative flex-100 logo center">
                <img src="<?php echo get_theme_file_uri('./assets/images/logo.png') ?>" alt="Primal Conquer Logo">
            </div>
            <nav class="flex-100 menu relative">
                <ul class="main-menu margin-center absolute flex evenly">
                    <li class="flex-20 main-menu-item center">
                        <a href="<?php echo site_url('/home') ?>">Home</a>
                    </li>
                    <li class="flex-20 main-menu-item center">
                        <a href="<?php echo site_url('/account') ?>">Account</a>
                    </li>
                    <li class="flex-20 main-menu-item dropdown center">
                        <a href="#">Server</a>
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
                        <a href="<?php echo site_url('/support') ?>">Support</a>
                    </li>
        <?php if (!$_SESSION['logged-in']) {?>
                    <li class="flex-20 main-menu-item dropdown center">
                        <a href="#">Login</a>
                        <div class="dropdown-menu login faded-black-bg">
                            <div class="form-wrapper">
                                <form method="post" action="<?php echo site_url() ?>">
                                    <div>
                                        <input name="username" type="text" placeholder="Username.">
                                    </div>
                                    <div>
                                        <input name="password" type="password" placeholder="Password">
                                    </div>

                                    <button name="login" class="btn btn-block" type="submit">Login</button><a class="center" href="<?php echo site_url('/forgot') ?>">Forgot password</a>
                                </form>
                            </div>
                        </div>
                    </li>
                    <?php } else {?>
                    <li class="flex-20 main-menu-item dropdown center">
                        <a href="#" ><i class="fas fa-user"></i></a>
                        <div class="dropdown-menu faded-black-bg">
                            <a class="inner-menu-item" href="<?php echo site_url('/profile') ?>">My Profile</a>
                            <form action="/" method="POST">
                            <button class="btn" name="logout" type="submit">Logout</button>
                            </form>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </nav>
            </div>
        </header>