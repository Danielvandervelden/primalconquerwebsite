<?php get_header();

 $changelog = new WP_Query(array(
     'post_type' => 'changelog',
     'post_count' => '4',
 ))

?>

<div class="main-content-container changelog">
    <main>
         <?php if ( $changelog->have_posts() ) : while ( $changelog->have_posts() ) : $changelog->the_post(); ?>
         
            <article class="post-container">
                        <?php if(get_the_post_thumbnail() != '') { ?>
                        <a class="link-picture-wrapper" href="<?php echo get_the_permalink() ?>"><div class="featured-image" style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>')"></div></a>
                        <?php } ?>
                        <div class="blog-post-inner-wrapper">
                        <h2><a href="<?php the_permalink(); ?>" alt="to blog post"><?php echo get_the_title(); ?></a></h2>
                        <div class="blog-post-content">
                            <?php echo get_the_excerpt(); ?>
                        </div>
                        </div>
                    </article>

        <?php  endwhile; else: ?>
            <p>Spec didn't put any rules here, feel free to abuse everything.</p>
        <?php endif; ?>
    </main>

    <aside>
        <?php echo get_template_part('template-parts/primal-sidebar'); ?>
    </aside>
</div>

<?php get_footer()?>
