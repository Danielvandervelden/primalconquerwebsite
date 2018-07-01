<?php 
    $hostIp = "104.238.159.58";
    $world1Server = false;
    $world2Server = false;
    $loginServer = false;
    $loggedin = $_SESSION['logged-in'];
    $username = $_SESSION['username'];

$fp1 = fsockopen($hostIP, '5816', $errno, $errstr, 2);
if($fp1) {
    $world1Server = true;
} 

// if(is_resource(fsockopen($hostIP, 5817, $errno, $errstr, 1))) {
//     $world2Server = true;
// }

$fp2 = fsockopen($hostIP, '9958', $errno, $errstr, 2);
if ($fp2) {
    $loginServer = true;
}


?>

<div class="sidebar flex evenly flex-column">
<?php if($loggedin) { ?>

    <div class="full-width spacing-top spacing-bottom flex j-evenly flex-column">
    <h2 class="flex-10 center hs">Welcome <?php echo $username ?>!</h2>

    <div class="center flex-10">
    <form method="post" action="<?php echo site_url('/profile') ?>">
     <button class="btn btn-block btn-dark btn-lg" type="submit">My Profile</button>
     </form>

    <form method="post" action="<?php echo site_url('/') ?>">
     <button name="logout" class="btn btn-block btn-dark btn-lg" type="submit">Logout</button>
     </form>
     </div>
   </div>

<?php } else { ?>
    <div class="spacing-top spacing-bottom clearfix">
    <div class="form-wrapper">
        <form class="post-container" method="post" action="<?php echo site_url() ?>">
        <h2 class="hs white t-shadow">Account Login</h2>
            <div class="form-group">
                <label for="username-side">Username</label>
                <input name="username" class="form-control" type="text" placeholder="Enter your username.">
            </div>

            <div class="form-group">
                <label for="password-side">Password</label>
                <input name="password" class="form-control" type="password" placeholder="Enter your password">
            </div>

            <button name="login" class="float-l btn btn-large" type="submit">Login</button><a class="float-r forgotpassword-login" href="<?php echo site_url('/forgot') ?>">Forgot password</a>
        </form>

    </div>
</div>

<?php } ?>


<div class="column spacing-top spacing-bottom three-cols center post-container full-width">
    <h2 class="hs">Server Status</h2>

<?php if($loginServer) { ?>
            
            <h2 class="hxs">Logon Server <i class="green fas fa-check-circle"></i></h2>
        <?php } else { ?>  
            <h2 class="hxs">Logon Server <i class="red fas fa-times-circle"></i></h2>
    <?php } ?>  

    <?php if($world1Server) { ?>
            
            <h2 class="hxs">World Server <i class="green fas fa-check-circle"></i></h2>
        <?php } else { ?>  
            <h2 class="hxs">World Server <i class="red fas fa-times-circle"></i></h2>
    <?php } ?>  

     <!-- <?php if ($world2Server) {?>

            <h2 class="hxs">World 2 Server <i class="green fas fa-check-circle"></i></h2>
        <?php } else {?>
            <h2 class="hxs">World 2 Server <i class="red fas fa-times-circle"></i></h2>
    <?php }?>
     -->
</div>
        </div>
