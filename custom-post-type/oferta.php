<?php

function offer_custom_post_type() {
    $supports = array(
        'title', // post title
        'editor', // post content
        //'thumbnail', // featured images
        //'excerpt', // post excerpt
        //'custom-fields', // custom fields
        'post-formats', // post formats
    );
    $labels = array(
        'name' => _x('Offers', 'plural', 'rawcodeplugin'),
        'singular_name' => _x('Offer', 'singular', 'rawcodeplugin'),
        'menu_name' => _x('Offers', 'admin menu', 'rawcodeplugin'),
        'name_admin_bar' => _x('Offers', 'admin bar', 'rawcodeplugin'),
        'add_new' => _x('Add New', 'add new', 'rawcodeplugin'),
        'add_new_item' => __('Add New', 'rawcodeplugin'),
        'new_item' => __('New offer', 'rawcodeplugin'),
        'edit_item' => __('Edit offer', 'rawcodeplugin'),
        'view_item' => __('View offer', 'rawcodeplugin'),
        'all_items' => __('All offer', 'rawcodeplugin'),
        'search_items' => __('Search for offer', 'rawcodeplugin'),
        'not_found' => __('No offer found.', 'rawcodeplugin'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'oferta'),
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 3,
		'menu_icon' => 'dashicons-analytics',
    );
    register_post_type('oferta', $args);
    }
    
add_action('init', 'offer_custom_post_type');


?>