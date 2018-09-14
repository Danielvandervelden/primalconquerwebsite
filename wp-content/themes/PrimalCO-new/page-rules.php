<?php get_header()?>

<div class="main-content-container single">
    <div class="flex" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">
        <div class="single-post-container flex-100">
            <main class="single-post-content margin-center blog-post-content">
                <?php   if (have_posts()) {
                    while (have_posts()) {
                        the_post();?>
                <div class="padding-top">
                    <div class="featured-image-single">
                        <?php echo get_the_post_thumbnail(); ?>
                    </div>
                    <h2 class="hm">
                        <?php the_title(); ?>
                    </h2>

                    <div>
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php } // end while ?>
                <?php } // end if
?>
            </main>
        </div>
    </div>
</div>

<?php get_footer()?>
