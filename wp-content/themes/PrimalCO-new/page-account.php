<?php 
    get_header();
?>

<div class="main-content-container register">
    <main>
        <div class="padding-sides" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">
    <h2 class="white center hl t-shadow padding-top">Create an account!</h2>
    <div class="form-wrapper margin-center">
        <form method="post" action="/account" class="margin-center">
            <div class="form-group">
                <label class="white" for="username">Username</label>
                <input class="form-control" name="register_username" type="text" placeholder="What will be your username?">
            </div>

            <div class="form-group">
                <label class="white"  for="password">Password</label>
                <input name="register_password" class="form-control" type="password" placeholder="Enter your chosen password">
            </div>

            <div class="form-group">
                <label class="white"  for="password">Re-enter password</label>
                <input name="register_password2" class="form-control" type="password" placeholder="Confirm your password">
            </div>

            <div class="form-group">
                <label class="white"  for="email">Email</label>
                <input name="register_email" class="form-control" type="email" placeholder="Please enter your email-address">
            </div>

            <div class="form-group">
                <label class="white"  for="question">Security Question</label>
                <input name="register_question" class="form-control" type="text" placeholder="Example: What's the name of my pet?">
            </div>

            <div class="form-group">
                <label class="white"  for="answer">Security Answer</label>
                <input name="register_answer" class="form-control" type="text" placeholder="Example: Franklin the Destroyer">
            </div>

             <div class="form-group">
                <label class="white" >Security Code</label>
                <input name="register_securitycode" class="form-control" type="text" placeholder="Enter your chosen security code.">
            </div>

            <div style="visibility: hidden; position: absolute; top: 0;" class="form-group">
                <label>Random</label>
                <input name="register_security" class="form-control" type="text" placeholder="security">
            </div>

            <button name="register" type="submit" class="btn btn-primary">Create your account!</button>
        </form>
    </div>
    </div>
    </main>
</div>


<?php 
    get_footer();
?>