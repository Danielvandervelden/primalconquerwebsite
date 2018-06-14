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

$frontpage_id = get_option( 'page_on_front' );

if(get_field('parallax_1')) {
    $headerImage =  get_field('parallax_1');
} else {
    $headerImage =  get_field('parallax_1', $frontpage_id);
}

if(get_field('parallax_2')) {
    $GLOBALS['contentImage'] = get_field('parallax_2');
} else {
    $GLOBALS['contentImage'] = get_field('parallax_2', $frontpage_id);

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
        <header class="parallax-container" style="background-image: url(<?php echo $headerImage ?>);">
            <div class="header-container">
            <div id="navbar" class="navbar">
                <nav class="navbar navbar-expand-lg navbar-light bg-light menu-nav">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav navbar-right mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo get_site_url() ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $accountLink ?>">Account</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Server</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo site_url('/downloads') ?>">Downloads</a>
                                    <a class="dropdown-item" href="<?php echo site_url('/rules') ?>">Rules</a>
                                    <a class="dropdown-item" href="<?php echo site_url('/changelog') ?>">Changelog</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('/support') ?>">Support</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="primalco-logo full-opacity">
                    <img src="<?php echo get_theme_file_uri('./assets/images/Logo.png') ?>" alt="Primal Conquer Logo">
                </div>

            <div class="text-message full-opacity">
                <h1>Welcome to Primal Conquer.</h1>
                <p>You have now entered an era far before the current. You've made a jump
                    in back in time to a place where Conquer Online was all about making friends,
                    having fun and gathering resources through sheer hard work. This server is
                    not for the faint hearted. The only thing you can do to become the best is 
                    put in effort. Have you got what it takes? Then register an account, download the
                    client and go forth!
                </p>
            </div>

            <div class="header-buttons-container">
                <div class="btn-header-div from-left">
                    <form action="<?php echo site_url('/downloads') ?>">
                    <button type="submit" class="btn-block btn btn-dark">Download our Client</button>
                    </form>
                </div>
                
                <div class="btn-header-div from-right">
                    <form action="<?php echo site_url('/account') ?>">
                    <button type="submit" class="btn-block btn btn-dark">Register an Account</button>
                    </form>
                </div>
            </div>
            </div>
            <!-- header container -->
        </header>
          <?php echo get_template_part('template-parts/primal-sidebar'); ?>