<?php

function changelog() {
	register_post_type('changelog', array(
		'public' => true,
		'labels' => array (
			'name' => 'Changelog',
			'add_new_item' => 'Add New Changelog',
			'edit_item' => 'Edit Changelog',
			'all_items' => 'All Changelogs',
			'singular_name' => 'Changelog',
		),
		'menu_icon' => 'dashicons-format-status',

	));
}

add_action('init', 'changelog');

function client()
{
    register_post_type('client', array(
        'public' => true,
        'labels' => array(
            'name' => 'Client or Patch',
            'add_new_item' => 'Add New Client or Patch',
            'edit_item' => 'Edit Client or Patch post',
            'all_items' => 'All Clients and Patch posts',
            'singular_name' => 'Client or Patch',
        ),
        'menu_icon' => 'dashicons-format-status',

    ));
}

add_action('init', 'client');

