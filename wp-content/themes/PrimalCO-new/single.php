<?php get_header()?>

<div class="main-content-container single">
<div class="parallax-container flex" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">
  <div class="single-post-container flex-100">
    <main class="single-post-content margin-center">
        <form action="<?php echo site_url('/news') ?>" method="POST">
            <button type="submit" class="absolute btn"><i class="fa fa-chevron-left"></i>Back to the News</button>
        </form>
     <?php   if (have_posts()) {
    while (have_posts()) {
        the_post();?>
        <div class="single-blog-post blog-post-content">
            <?php if (has_post_thumbnail(get_the_ID())) {?>
	                <div class="featured-image-single"><?php echo get_the_post_thumbnail(); ?></div>
            <?php }?>

                <div>
                <h2 class="hm"><?php the_title(); ?></h2>    
                <?php the_content(); ?></div>
        </div>
                <?php } // end while ?>
                <?php } // end if
?>
    </main>
</div>
</div>
</div>

<?php get_footer()?>
