
<?php echo get_template_part('template-parts/technologies'); ?>
<footer class="clearfix relative">
    <ul class="padding-top padding-bottom margin-center flex evenly">
        <li class="flex-20 center main-menu-item">
            <a href="<?php echo site_url('/home') ?>">Home</a>
        </li>
        <li class="flex-20 center main-menu-item">
            <a href="<?php echo site_url('/account') ?>">Account</a>
        </li>
        <li class="flex-20 center main-menu-item">
            <a href="<?php echo site_url('/downloads') ?>">Downloads</a>
        </li>
        <li class="flex-20 center main-menu-item">
            <a href="<?php echo site_url('/rules') ?>">Rules</a>
        </li>
        <li class="flex-20 center main-menu-item">
            <a href="<?php echo site_url('/support') ?>">Support</a>
        </li>
    </ul>

    <div class="social-container flex evenly margin-center center">
        <div class="flex-33">
            <a href="https://www.facebook.com/PrimalConquer/"><i class="white fab fa-facebook-f"></i></a>
        </div>
        <div class="flex-33">
            <a href="http://www.elitepvpers.de" target="_blank"><img class="epvp-logo" src="<?php echo get_theme_file_uri('./assets/images/elitepvpers-shield.png') ?>" alt="ElitePVPers logo" /></a>
        </div>
        <div class="flex-33">
            <a href="https://www.youtube.com/channel/UCF07MuYVw26fmSXTVE3_5XA"><i class="white fab fa-youtube"></i></a>
        </div>
    </div>

    <p class="white center font-xs">Made exclusively for Primal Conquer. Dan © </p>
</footer>
</div> <!-- end of container div -->
</body>
</html>

<?php
wp_footer();