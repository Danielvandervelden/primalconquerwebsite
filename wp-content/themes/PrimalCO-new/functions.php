<?php

// Let's load all the styles and JS shall we?

/*
80.240.30.167
User: Administrator Password: Summer2k18
*/


function primal_files()
{
	wp_enqueue_script('primal_js', get_theme_file_uri('js/script.js'), array('jquery'), null, '1.0', true);
	wp_enqueue_script('owl-carousel-js', get_theme_file_uri('js/owl-carousel/owl.carousel.min.js'), array('jquery'), null, '1.0', true);
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/styles/owl-carousel/owl.carousel.min.css');
	wp_enqueue_style('owl-carousel-default', get_template_directory_uri() . '/styles/owl-carousel/owl.theme.default.min.css');

    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro');
    wp_enqueue_style('style.css', get_stylesheet_uri());
    wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.0.12/css/all.css');

    
}

add_action('wp_enqueue_scripts', 'primal_files');


// LOAD DIFFERENT FEATURES SUCH AS MENU PLACES, SUPPORT FOR THUMBNAILS, TITLE TAGS, ETC.
function primal_features() {
	register_nav_menu('headerMenuLocation', 'Header Menu Location');
	register_nav_menu('footerMenuLocation', 'Footer Menu Location');
	add_theme_support('title-tag');
	add_theme_support( 'post-thumbnails');
	add_image_size('thumbnailimage', 150, auto, false);
	add_image_size('header_mobile', 768, auto, false);
	add_image_size('header_full', 2500, auto, false);
	add_image_size('thumbnailimagesingle', 300, auto, true);
	add_post_type_support( 'page', 'excerpt' );
}
add_action('after_setup_theme', 'primal_features');

// Remove WYSIWYG editor from Client & Patch post type.. 

function init_remove_support()
{
    $post_type = 'client';
    remove_post_type_support($post_type, 'editor');
}
add_action('init', 'init_remove_support');

function primal_vars() {
	static $serverstatus = true;

	return $serverstatus;
}
add_action('template_redirect', 'primal_vars');

function wpbeginner_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";
 
}