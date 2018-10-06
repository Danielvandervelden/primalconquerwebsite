<?php 
get_header();
require 'database/db.php';

$servers = Array('ConquerGods');

?>

<div class="main-content-container padding-top padding-bottom">

    <form action="/transfer" method="POST" class="margin-center">
        <div class="spacing-top spacing-bottom spacing-left spacing-right">
            <p class="white"><?php the_content(); ?></p>
        </div>
        
        <div class="form-group">
            <label for="username">Username on the other server</label>
            <input type="text" name="username" placeholder="Username" />
        </div>

        <div class="form-group">
            <label for="password">Password on the other server</label>
            <input type="password" name="password" placeholder="Password" />
        </div>
        <label></label>
        <select name="server" class="server-select">
        <?php
        $i = 0;
        foreach($servers as $server) {
            echo '<option name="' . $server . '">' . $server . '</option>';
        }
        ?>
        </select>
        <button name="submit_transfer" class="btn spacing-top" type="submit">TRANSFER ME!</button>
    </form>
</div>



<?php
get_footer();
?>