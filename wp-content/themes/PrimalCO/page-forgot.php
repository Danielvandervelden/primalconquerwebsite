<?php
get_header();

?>
<div class="main-content-container rules">
    <main>
        <form action="/forgot" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" name="username" type="text" placeholder="Enter your current username." value="<?php echo $username ?>">
        </div>

        <div class="form-group">
            <label for="password"> Current Email</label>
            <input name="email" class="form-control" type="email" placeholder="Enter your current password">
        </div>
         <button name="forgot_password" type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </main>

    <aside>
        <?php echo get_template_part('template-parts/primal-sidebar'); ?>
    </aside>
</div>
<?php 
get_footer();
?>