<?php 
 get_header();

 if(get_the_post_thumbnail() != '') {
 $backgroundImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnailimagesingle');
 }  else {
     $backgroundImg = null;
 }

?>
    <div class="main-content-container">
        <main>
            <?php
            if (have_posts()) {
                while (have_posts()) {
                 the_post(); ?>
                <article class="post-container">
                    <?php if(get_the_post_thumbnail() != '') { ?>
                    <a class="link-picture-wrapper" href="<?php echo get_the_permalink() ?>"><div class="featured-image" style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>')"></div></a>
                    <?php } ?>
                    <div class="blog-post-inner-wrapper">
                        <h2>
                            <a href="<?php the_permalink(); ?>" alt="to blog post">
                                <?php echo get_the_title(); ?>
                            </a>
                        </h2>
                        <div class="blog-post-content">
                            <?php echo get_the_excerpt(); ?>
                        </div>
                    </div>
                </article>

                <?php   } // end while ?>
                <?php      } // end if 
       
                        echo paginate_links();
      ?>
        </main>

        <aside>
            <?php echo get_template_part('template-parts/primal-sidebar'); ?>
        </aside>


    </div>
    <!-- end of main-content-container -->
<?php
get_footer();
?>