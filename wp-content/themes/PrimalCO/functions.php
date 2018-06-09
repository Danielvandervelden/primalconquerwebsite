<?php

// Let's load all the styles and JS shall we?

/*
80.240.30.167
User: Administrator Password: Summer2k18
*/


function primal_files()
{
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro');
    wp_enqueue_style('style.css', get_stylesheet_uri());
    wp_enqueue_script('primal_js', get_theme_file_uri('js/script.js'), array('jquery'), null, '1.0', true);
    wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/releases/v5.0.1/js/all.js', array(), null);
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/stylecomponents/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.0.0', true);

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