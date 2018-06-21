<?php 
    $authServer = true;
    $loginServer = true;
    $loggedin = $_SESSION['logged-in'];
    $username = $_SESSION['username'];
?>

<div class="sidebar flex evenly flex-column">
<?php if($loggedin) { ?>

    <div class="full-width spacing-top spacing-bottom flex j-evenly row-column">
    <h2 class="center hl">Welcome <?php echo $username ?>!</h2>

    <div class="center">
    <form method="post" action="<?php echo site_url() ?>">
     <button name="logout" class="btn btn-block btn-dark btn-lg" type="submit">Logout</button>
     </form>

      <form method="post" action="<?php echo site_url('/profile') ?>">
     <button class="btn btn-block btn-dark btn-lg" type="submit">My Profile</button>
     </form>
     </div>
   </div>

<?php } else { ?>
    <div class="spacing-top spacing-bottom clearfix">
    <div class="form-wrapper">
        <h2 class="hm white t-shadow">Login to your account</h2>
        <form class="post-container" method="post" action="<?php echo site_url() ?>">
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

    <?php if($authServer) { ?>
            
            <h2 class="auth-login">Auth Server Status: <span style="color: green; font-weight: bold;">ONLINE</span></h2>
        <?php } else { ?>  
            <h2 class="auth-login">Auth Server Status: <span style="color: red; font-weight: bold;">OFFLINE</span></h2>
    <?php } ?>  
    
    <?php if($loginServer) { ?>
            
            <h2 class="auth-login">Login Server Status: <span style="color: green; font-weight: bold;">ONLINE</span></h2>
        <?php } else { ?>  
            <h2 class="auth-login">Login Server Status: <span style="color: red; font-weight: bold;">OFFLINE</span></h2>
    <?php } ?>  
</div>
        </div>
