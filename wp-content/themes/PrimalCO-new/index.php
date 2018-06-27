<?php get_header(); 

?>

<div class="post-overview">
    <main>
        <h2 class="hm white center">All News posts</h2>
        <div class="posts-container">
		
		   <?php 
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;  
		   	$changelog = new WP_Query(array(
                "post_type" => "changelog",
				"posts_per_page" => 3,
				'paged' => $paged
                ));
                if ($changelog->have_posts()) { ?>
                    <?php while ($changelog->have_posts()): $changelog->the_post();?>
	                    <article class="blog-post-content post-container news flex">
	                        <?php if (has_post_thumbnail( get_the_ID() )) { ?>
	                        <a class="link-picture-wrapper" href="<?php echo get_the_permalink() ?>"><div class="featured-image" style="background-image: url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id())[0] ?>')"></div></a>
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

	                    <?php endwhile;
                     } ?>
                    <div class="pagination center spacing-top">
						<?php 
							echo paginate_links( array(
								'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
								'total'        => $changelog->max_num_pages,
								'current'      => max( 1, get_query_var( 'paged' ) ),
								'format'       => '?paged=%#%',
								'show_all'     => false,
								'type'         => 'plain',
								'end_size'     => 1,
								'mid_size'     => 1,
								'prev_next'    => true,
								'prev_text'    => sprintf( '<i></i> %1$s', __( '<i class="fas fa-caret-square-left"></i>', 'text-domain' ) ),
								'next_text'    => sprintf( '%1$s <i></i>', __( '<i class="fas fa-caret-square-right"></i>', 'text-domain' ) ),
								'add_args'     => false,
								'add_fragment' => '',
							) );
						?>
</div>
        </div>
    </main>
</div>
<?php get_footer(); ?>