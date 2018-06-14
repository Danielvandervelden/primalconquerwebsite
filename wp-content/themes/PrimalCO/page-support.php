<?php get_header()?>

<div class="main-content-container rules">
    <main>
     <div class="parallax-container flex" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">

     <div class="one-col single-post-container">
    <h2><?php the_title();?></h2>
    <div class="rules-wrapper">
        <?php if (have_posts()): while (have_posts()): the_post();
        the_content();
    endwhile;else: ?>
            <p>Spec didn't put any rules here, feel free to abuse everything.</p>
        <?php endif;?>
    </div>
    </div>
    </div>
    </main>
</div>

<?php get_footer()?>
