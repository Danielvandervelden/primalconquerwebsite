<?php echo get_template_part('template-parts/technologies'); ?>
<?php echo get_template_part('template-parts/discord-block'); ?>
<footer>
    <div class="whitebar padding-bottom padding-top gray-bg evenly flex">
        <div class="three-cols">
            <h3 class="white hs center">Partners</h3>
            <ul>
            <li><a href="https://www.elitepvpers.de">ElitePVPers</a></li>
            </ul>
        </div>
        <div class="three-cols">
            <h3 class="white hs center">Account management</h3>
            <ul>
                <li><a href="<?php echo site_url('/account') ?>">Register</a></li>
                <li><a href="<?php echo site_url('/forgot') ?>">Forgot Password</a></li>
            </ul>
        </div>
        <div class="three-cols">
            <h3 class="white hs center">Navigation</h3>
            <ul>
                <li><a href="<?php echo site_url('/') ?>">Home</a></li>
                <li><a href="<?php echo site_url('/account') ?>">Account</a></li>
                <li><a href="<?php echo site_url('/rules') ?>">Rules</a></li>
                <li><a href="<?php echo site_url('/downloads') ?>">Downloads</a></li>
                <li><a href="<?php echo site_url('/changelog') ?>">Changelog</a></li>
            </ul>
        </div>
    </div>
    <div>
        <p>Website created by the allmighty Dan A.K.A. Anti, to be used for Primal Conquer (yes, it's still under construction)</p>
    </div>
</footer>
</div> <!-- end of container div -->
</body>
</html>

<?php
wp_footer();