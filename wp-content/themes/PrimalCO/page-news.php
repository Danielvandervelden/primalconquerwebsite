<?php get_header(); ?>

<div class="main-content-container post-overview">
    <main>
        <div class="parallax-container flex" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">
            <div class="margin-center">
                <?php
$news = new WP_Query(array(
    "post_type" => "post",
    "posts_per_page" => -1,
));
if ($news->have_posts()): ?>
                    <?php while ($news->have_posts()): $news->the_post();?>
                    <article class="post-container flex">
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
                                <?php echo get_the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
 
                    <?php endwhile; ?>
                            <?php wpbeginner_numeric_posts_nav()?>
                            <?php paginate_links(); ?>
                    <?php else: ?>
                    <?php endif;?>
            </div>

        </div>
    </main>
</div>
<?php get_footer(); ?>