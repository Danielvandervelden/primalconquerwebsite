<?php get_header()?>

<div class="main-content-container single">
    <form action="<?php echo site_url('/') ?>" method="POST">
    <button type="submit" class="absolute-top btn btn-dark"><i class="fa fa-chevron-left"></i>Back to the homepage</button>
    </form>
    <main>
     <?php   if (have_posts()) {
    while (have_posts()) {
        the_post();?>
        <div class="post-container">
            <div class="featured-image-single"><?php echo get_the_post_thumbnail(); ?></div>
                <h2><?php the_title(); ?></h2>

                <div class="single-post-content"><?php the_content(); ?></div>
        </div>
                <?php } // end while ?>
                <?php } // end if
?>
    </main>

    <aside>
        <?php echo get_template_part('template-parts/primal-sidebar'); ?>
    </aside>
</div>

<?php get_footer()?>
