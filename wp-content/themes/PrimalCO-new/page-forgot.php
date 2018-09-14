<?php
get_header();

?>
<div class="main-content-container rules">
    <main>
    <div style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">
    <div class="padding-sides form-wrapper margin-center padding-top">
        <form action="/forgot" method="POST">
        <div class="form-group">
            <label class="white hm" for="username">Username</label>
            <input class="form-control" name="forgot_password_username" type="text" placeholder="Enter your username." value="<?php echo $username ?>">
        </div>

        <div class="form-group">
            <label class="white hm" for="password"> Current Email</label>
            <input name="forgot_password_email" class="form-control" type="email" placeholder="Enter your email">
        </div>
         <button name="forgot_password" type="submit" class="btn btn-primary">Change Password</button>
        </form>
</div>
        </div>
    </main>
</div>
<?php 
get_footer();
?>