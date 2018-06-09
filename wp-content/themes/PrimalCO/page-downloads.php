<?php get_header(); 

$client = new WP_Query(array(
     'post_type' => 'client',
     'post_count' => '0',
));

?>

<div class="main-content-container downloads">

    <main>
        <h2>Client Downloads</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Version</th>
                    <th scope="col">Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
            if ($client->have_posts()) {
                while ($client->have_posts()) {
                 $client->the_post();

                 $clientorpatch = get_field('client_or_patch');

                 if($clientorpatch === 'Client') { 
                  ?>
                    <tr>
                        <td><?php the_field('name') ?></td>
                        <td><?php the_field('version') ?></td>
                        <td><a href="<?php the_field('download_link') ?>">Download</a></td>
                    </tr>
                    <?php   } // end while ?>
                    <?php   } // end while ?>
                    <?php      } // end if   ?>
            </tbody>
        </table>

        <h2>Patches Downloads</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Patch Number</th>
                    <th scope="col">Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
            if ($client->have_posts()) {
                while ($client->have_posts()) {
                 $client->the_post();

                 $clientorpatch = get_field('client_or_patch');

                 if($clientorpatch === 'Patch') { 
                  ?>
                    <tr>
                        <td><?php the_field('name') ?></td>
                        <td><a href="<?php the_field('download_link') ?>">Download</a></td>
                    </tr>
                    <?php   } // end while ?>
                    <?php   } // end while ?>
                    <?php      } // end if   ?>
            </tbody>
        </table>
    </main>

    <aside>
        <?php echo get_template_part('template-parts/primal-sidebar'); ?>
    </aside>
</div>

<?php get_footer();