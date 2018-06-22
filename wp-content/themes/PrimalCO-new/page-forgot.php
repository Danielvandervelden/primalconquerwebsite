<?php
get_header();

?>
<div class="main-content-container rules">
    <main>
    <div class="parallax-container" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">
    <div class="form-wrapper margin-center padding-top">
        <form action="/forgot" method="POST">
        <div class="form-group">
            <label class="white hm" for="username">Username</label>
            <input class="form-control" name="username" type="text" placeholder="Enter your current username." value="<?php echo $username ?>">
        </div>

        <div class="form-group">
            <label class="white hm" for="password"> Current Email</label>
            <input name="email" class="form-control" type="email" placeholder="Enter your current password">
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