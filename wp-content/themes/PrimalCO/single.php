<?php get_header()?>

<div class="main-content-container single">
<div class="parallax-container flex" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">
  <div class="single-post-container one-col">
    <form action="<?php echo site_url('/') ?>" method="POST">
    <button type="submit" class="absolute-top btn btn-dark"><i class="fa fa-chevron-left"></i>Back to the homepage</button>
    </form>
    <main>
     <?php   if (have_posts()) {
    while (have_posts()) {
        the_post();?>
        <div>
            <div class="featured-image-single"><?php echo get_the_post_thumbnail(); ?></div>
                <h2 class="hm"><?php the_title(); ?></h2>

                <div class="single-post-content"><?php the_content(); ?></div>
        </div>
                <?php } // end while ?>
                <?php } // end if
?>
    </main>
</div>
</div>
</div>

<?php get_footer()?>
