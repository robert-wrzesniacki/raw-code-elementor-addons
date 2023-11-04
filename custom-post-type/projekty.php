<?php

function projects_custom_post_type() {
    $supports = array(
        'title', // post title
        // 'editor', // post content
        'thumbnail', // featured images
        'excerpt', // post excerpt
       // 'custom-fields', // custom fields
        'post-formats', // post formats
    );
    $labels = array(
        'name' => _x('Projects', 'plural', 'rawcodeplugin'),
        'singular_name' => _x('Project', 'singular', 'rawcodeplugin'),
        'menu_name' => _x('Projects', 'admin menu', 'rawcodeplugin'),
        'name_admin_bar' => _x('Projects', 'admin bar', 'rawcodeplugin'),
        'add_new' => _x('Add New', 'add new', 'rawcodeplugin'),
        'add_new_item' => __('Add New', 'rawcodeplugin'),
        'new_item' => __('New project Entery', 'rawcodeplugin'),
        'edit_item' => __('Edit project Entery', 'rawcodeplugin'),
        'view_item' => __('View project Entery', 'rawcodeplugin'),
        'all_items' => __('All projects', 'rawcodeplugin'),
        'search_items' => __('Search in projects', 'rawcodeplugin'),
        'not_found' => __('No projects entery found.', 'rawcodeplugin'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'projekty'),
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 3,
		'menu_icon' => 'dashicons-portfolio',
       
    );
    register_post_type('projekty', $args);
    
    register_taxonomy(
        'projects-category', 
        'projekty', 
        array(
            'hierarchical' => true, 
            'label' => __('Categories', 'rawcodeplugin'),
            'query_var' => true, 
            'rewrite' => array( 'slug' => 'projects-category' ),
            'publicly_queryable' => false
        )
    );

    }
    
add_action('init', 'projects_custom_post_type');


?>