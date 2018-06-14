<?php get_header(); 

$client = new WP_Query(array(
     'post_type' => 'client',
     'posts_per_page' => 99
));

?>

<div class="main-content-container downloads">
    <main>
         <div class="parallax-container flex evenly flex-column" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">

         <div class="clients two-cols">
        <h2>Client Downloads</h2>
        <table class="table">
            <thead>
                <tr class="flex between center">
                    <th class="three-cols" scope="col">Name</th>
                    <th class="three-cols" scope="col">Version</th>
                    <th class="three-cols" scope="col">Download</th>
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
                    <tr class="flex flex-row between center">
                        <td class="three-cols"><?php the_field('name') ?></td>
                        <td class="three-cols"><?php the_field('version') ?></td>
                        <td class="three-cols"><a href="<?php the_field('download_link') ?>">Download</a></td>
                    </tr>
                    <?php   } // end while ?>
                    <?php   } wp_reset_postdata(); // end while ?>
                    <?php      }  // end if   ?>
            </tbody>
        </table>
        </div>

        <div class="patches two-cols">
        <h2>Patches Downloads</h2>
        <table class="table last">
            <thead>
                <tr class="flex between flex-row center">
                    <th class="two-cols" scope="col">Patch Number</th>
                    <th class="two-cols" scope="col">Download</th>
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
                    <tr class="flex flex-row between center">
                        <td class="two-cols"><?php the_field('name') ?></td>
                        <td class="two-cols"><a href="<?php the_field('download_link') ?>">Download</a></td>
                    </tr>
                    <?php   } // end while ?>
                    <?php   } wp_reset_postdata(); // end while ?>
                    <?php      } // end if   ?>
            </tbody>
        </table>
        </div>
            </div>
    </main>
</div>

<?php get_footer();