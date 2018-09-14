<?php get_header(); 

$client = new WP_Query(array(
     'post_type' => 'client',
     'posts_per_page' => 99
));

?>

<div class="main-content-container downloads">
    <main>
         <div class="flex evenly flex-column" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">

         <div class="clients flex-50">
        <h2 class="center hm t-shadow white">Client Downloads</h2>
        <table class="table">
            <thead>
                <tr class="flex between center">
                    <th class="flex-30" scope="col">Name</th>
                    <th class="flex-30" scope="col">Version</th>
                    <th class="flex-30" scope="col">Download</th>
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
                        <td class="flex-30"><?php the_field('name') ?></td>
                        <td class="flex-30"><?php the_field('version') ?></td>
                        <td class="flex-30"><a href="<?php the_field('download_link') ?>">Download</a></td>
                    </tr>
                    <?php   } // end while ?>
                    <?php   } wp_reset_postdata(); // end while ?>
                    <?php      }  // end if   ?>
            </tbody>
        </table>
        </div>

        <div class="patches flex-50">
        <h2 class="center hm t-shadow white">Patches Downloads</h2>
        <table class="table last">
            <thead>
                <tr class="flex between flex-row center">
                    <th class="flex-50" scope="col">Patch Number</th>
                    <th class="flex-50" scope="col">Download</th>
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
                        <td class="flex-50"><?php the_field('name') ?></td>
                        <td class="flex-50"><a href="<?php the_field('download_link') ?>">Download</a></td>
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