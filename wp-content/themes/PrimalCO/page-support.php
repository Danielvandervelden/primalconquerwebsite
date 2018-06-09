<?php get_header()?>

<div class="main-content-container rules">
    <main>
    <h2><?php the_title();?></h2>
    <div class="rules-wrapper">
        <?php if (have_posts()): while (have_posts()): the_post();
        the_content();
    endwhile;else: ?>
            <p>Spec didn't put any rules here, feel free to abuse everything.</p>
        <?php endif;?>
    </div>
    </main>

    <aside>
        <?php echo get_template_part('template-parts/primal-sidebar'); ?>
    </aside>
</div>

<?php get_footer()?>
