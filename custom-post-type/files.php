<?php

function files_custom_post_type() {
    $supports = array(
        'title', // post title
        'editor', // post content
        //'thumbnail', // featured images
        //'excerpt', // post excerpt
        //'custom-fields', // custom fields
        'post-formats', // post formats
    );
    $labels = array(
        'name' => _x('Files', 'plural', 'rawcodeplugin'),
        'singular_name' => _x('File', 'singular', 'rawcodeplugin'),
        'menu_name' => _x('Files', 'admin menu', 'rawcodeplugin'),
        'name_admin_bar' => _x('Files', 'admin bar', 'rawcodeplugin'),
        'add_new' => _x('Add New', 'add new', 'rawcodeplugin'),
        'add_new_item' => __('Add New', 'rawcodeplugin'),
        'new_item' => __('New file', 'rawcodeplugin'),
        'edit_item' => __('Edit file', 'rawcodeplugin'),
        'view_item' => __('View file', 'rawcodeplugin'),
        'all_items' => __('All files', 'rawcodeplugin'),
        'search_items' => __('Search for file', 'rawcodeplugin'),
        'not_found' => __('No files found.', 'rawcodeplugin'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'pliki'),
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 3,
		'menu_icon' => 'dashicons-media-document',
    );
    register_post_type('pliki', $args);

    register_taxonomy(
        'files-category', 
        'pliki', 
        array(
            'hierarchical' => true, 
            'label' => __('Categories', 'rawcodeplugin'),
            'query_var' => true, 
            'rewrite' => array( 'slug' => 'files-category' )
        )
    );

    }
    
add_action('init', 'files_custom_post_type');
