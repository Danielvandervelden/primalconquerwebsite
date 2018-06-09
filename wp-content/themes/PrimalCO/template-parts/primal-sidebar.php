<?php 
    $serverstatus = true;
    $loggedin = $_SESSION['logged-in'];
    $username = $_SESSION['username'];
?>

<?php if($loggedin) { ?>

    <div class="sidebar-div loggedin">
    <h2>Welcome <?php echo $username ?>!</h2>
    <form method="post" action="<?php echo site_url() ?>">
     <button name="logout" class="btn btn-dark" type="submit">Logout</button>
     </form>

      <form method="post" action="<?php echo site_url('/profile') ?>">
     <button class="btn btn-dark" type="submit">My Profile</button>
     </form>
   </div>

<?php } else { ?>
    <div class="login-form sidebar-div">
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

            <button name="login" class="btn btn-dark" type="submit">Login</button>
        </form>

    </div>
</div>

<?php } ?>


<div class="sidebar-div">

    <?php if($serverstatus) { ?>
            
            <h2>Server is: <span style="color: green; font-weight: bold;">ONLINE</span></h2>
            <p>There are currently <span>999</span> players online</p>
        <?php } else { ?>  
            <h2>Server is: <span style="color: red; font-weight: bold;">OFFLINE</span></h2>
    <?php } ?>             
</div>

<div class="facebook-container">
    <?php echo do_shortcode("[custom-facebook-feed]") ?>
</div>
