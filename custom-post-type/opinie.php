<?php

function opinions_custom_post_type() {
    $supports = array(
        'title', // post title
        'editor', // post content
        //'thumbnail', // featured images
        //'excerpt', // post excerpt
        //'custom-fields', // custom fields
        'post-formats', // post formats
    );
    $labels = array(
        'name' => _x('Opinions', 'plural', 'rawcodeplugin'),
        'singular_name' => _x('Opinion', 'singular', 'rawcodeplugin'),
        'menu_name' => _x('Opinions', 'admin menu', 'rawcodeplugin'),
        'name_admin_bar' => _x('Opinions', 'admin bar', 'rawcodeplugin'),
        'add_new' => _x('Add New', 'add new', 'rawcodeplugin'),
        'add_new_item' => __('Add New', 'rawcodeplugin'),
        'new_item' => __('New opinion', 'rawcodeplugin'),
        'edit_item' => __('Edit opinion', 'rawcodeplugin'),
        'view_item' => __('View opinion', 'rawcodeplugin'),
        'all_items' => __('All opinions', 'rawcodeplugin'),
        'search_items' => __('Search for opinion', 'rawcodeplugin'),
        'not_found' => __('No opinion found.', 'rawcodeplugin'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'opinie'),
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 3,
		'menu_icon' => 'dashicons-editor-quote',
    );
    register_post_type('opinie', $args);
    }
    
add_action('init', 'opinions_custom_post_type');


?>