<?php 
    $authServer = true;
    $loginServer = true;
    $loggedin = $_SESSION['logged-in'];
    $username = $_SESSION['username'];
?>

<div class="whitebar-container flex evenly row-column">
<?php if($loggedin) { ?>


    <div class="spacing-top spacing-bottom three-cols flex evenly flex-column">
    <h2>Welcome <?php echo $username ?>!</h2>

    <div class="flex">
    <form class="two-cols" method="post" action="<?php echo site_url() ?>">
     <button name="logout" class="btn btn-dark" type="submit">Logout</button>
     </form>

      <form class="two-cols" method="post" action="<?php echo site_url('/profile') ?>">
     <button class="btn btn-dark" type="submit">My Profile</button>
     </form>
     </div>
   </div>

<?php } else { ?>
    <div class="spacing-top spacing-bottom three-cols">
    <div class="form-wrapper">
        <h2>Login to your account</h2>
        <form method="post" action="<?php echo site_url() ?>">
            <div class="form-group">
                <label for="username-side">Username</label>
                <input name="username" class="form-control" type="text" placeholder="Enter your username.">
            </div>

            <div class="form-group">
                <label for="password-side">Password</label>
                <input name="password" class="form-control" type="password" placeholder="Enter your password">
            </div>

            <button name="login" class="btn btn-dark" type="submit">Login</button><a class="float-r" href="<?php echo site_url('/forgot') ?>">Forgot password</a>
        </form>

    </div>
</div>

<?php } ?>


<div class="column spacing-top spacing-bottom three-cols center whitebar ">

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

<div class="spacing-top spacing-bottom three-cols">
    <?php echo do_shortcode("[custom-facebook-feed]") ?>
</div>
        </div>
