<?php 

?>
    <form method="post" action="/profile">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" name="username" type="text" placeholder="Enter your current username." value="<?php echo $username ?>">
            </div>

            <div class="form-group">
                <label for="password"> Current Password</label>
                <input name="current-password-form" class="form-control" type="password" placeholder="Enter your current password">
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input name="new-password" class="form-control" type="password" placeholder="Enter you new password">
            </div>

            <div class="form-group">
                <label for="password">Re-enter New Password</label>
                <input name="new-password2" class="form-control" type="password" placeholder="Confirm your new password" value="<?php echo $email ?>">
            </div>

            <button name="password_change" type="submit" class="btn btn-primary">Change Password</button>
        </form>