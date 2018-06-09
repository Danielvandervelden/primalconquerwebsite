<?php 
    get_header();
?>

<div class="main-content-container register">
    <main>
    <h2>Create an account!</h2>
    <div class="form-wrapper register">
        <form method="post" action="/account">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" name="username" type="text" placeholder="What will be your username?">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" class="form-control" type="password" placeholder="Enter your chosen password">
            </div>

            <div class="form-group">
                <label for="password">Re-enter password</label>
                <input name="password2" class="form-control" type="password" placeholder="Confirm your password">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" class="form-control" type="email" placeholder="Please enter your email-address">
            </div>

            <div class="form-group">
                <label for="question">Security Question</label>
                <input name="question" class="form-control" type="text" placeholder="Example: What date did I lose my virginity?">
            </div>

            <div class="form-group">
                <label for="answer">Security Answer</label>
                <input name="answer" class="form-control" type="text" placeholder="Exampe: FML, I'm still a virgin..">
            </div>

             <div class="form-group">
                <label>Security Code</label>
                <input name="securitycode" class="form-control" type="text" placeholder="Enter your chosen security code.">
            </div>

            <div style="visibility: hidden; position: absolute; top: 0;" class="form-group">
                <label>Random</label>
                <input name="security" class="form-control" type="text" placeholder="security">
            </div>

            <button name="register" type="submit" class="btn btn-primary">Create your account!</button>
        </form>
    </div>
    </main>

    <aside>
        <?php echo get_template_part('template-parts/primal-sidebar'); ?>
    </aside>
</div>


<?php 
    get_footer();
?>