<?php
get_header();

?>
 <?php echo get_template_part('template-parts/why-us'); ?>
    <div class="flex row-column margin-center br3">
        <main class="full-width">

            <div class="flex flex-row-column j-evenly" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">
                <div class="flex-70 spacing-left spacing-right">
                    <h2 class="white center hm spacing-top">Latest news</h2>

                    <?php
                        $normalPost = new WP_Query(array(
                            "post_type" => "post",
                            "posts_per_page" => 1,
                        ));

                        if ($normalPost->have_posts())
                            while ($normalPost->have_posts()): $normalPost->the_post();
                            ?>
                        <article class="post-container">
                            <?php if (get_the_post_thumbnail() != '') {?>
                            <a class="link-picture-wrapper" href="<?php echo get_the_permalink() ?>"><div class="featured-image" style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>')"></div></a>
                            <?php }?>
                            <div class="blog-post-inner-wrapper">
                                <h3>
                                    <a href="<?php the_permalink();?>" alt="to blog post">
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </h3>
                                <div class="blog-post-content">
                                    <?php echo wp_trim_words(get_the_content(), 150); ?>
                                </div>
                            </div>
                        </article>

                        <?php endwhile;
wp_reset_postdata(); // end while ?>

                </div>

                <div class="flex-30 spacing-left spacing-right">
                        <?php echo get_template_part('template-parts/primal-sidebar'); ?>
                </div>

            </div>
        </main>
    </div>
    <!-- end of main-content-container -->
    <?php
get_footer();
?>