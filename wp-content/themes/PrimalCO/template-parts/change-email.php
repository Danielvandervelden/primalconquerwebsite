<form method="post" action="/profile">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" name="username" type="text" placeholder="Enter your current username." value="<?php echo $username ?>">
            </div>

            <div class="form-group">
                <label for="password"> Current Email</label>
                <input name="current-email-form" class="form-control" type="email" placeholder="Enter your current password">
            </div>

            <div class="form-group">
                <label for="password">New Email</label>
                <input name="new-email" class="form-control" type="email" placeholder="Enter you new password">
            </div>

            <div class="form-group">
                <label for="password">Enter your password</label>
                <input name="password" class="form-control" type="password" placeholder="Confirm your new password" value="<?php echo $email ?>">
            </div>

            <button name="email_change" type="submit" class="btn btn-primary">Change Password</button>
        </form>