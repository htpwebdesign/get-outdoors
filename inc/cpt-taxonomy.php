<?php 

function go_register_custom_post_types() {
    $labels = array(
        'name'               => _x( 'Event', 'post type general name' ),
        'singular_name'      => _x( 'Event', 'post type singular name'),
        'menu_name'          => _x( 'Event', 'admin menu' ),
        'name_admin_bar'     => _x( 'Event', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'event' ),
        'add_new_item'       => __( 'Add New Event' ),
        'new_item'           => __( 'New Event' ),
        'edit_item'          => __( 'Edit Event' ),
        'view_item'          => __( 'View Event' ),
        'all_items'          => __( 'All Event' ),
        'search_items'       => __( 'Search Event' ),
        'parent_item_colon'  => __( 'Parent Event:' ),
        'not_found'          => __( 'No event found.' ),
        'not_found_in_trash' => __( 'No event found in Trash.' ),
        'archives'           => __( 'Event Archives'),
        'insert_into_item'   => __( 'Insert into event'),
        'uploaded_to_this_item' => __( 'Uploaded to this event'),
        'filter_item_list'   => __( 'Filter event list'),
        'items_list_navigation' => __( 'Event list navigation'),
        'items_list'         => __( 'Event list'),
        'featured_image'     => __( 'Event featured image'),
        'set_featured_image' => __( 'Set Event featured image'),
        'remove_featured_image' => __( 'Remove Event featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'event' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'thumbnail','editor' ),
    );
    register_post_type( 'go-event', $args );
}


add_action( 'init', 'go_register_custom_post_types' );

// Fleshes permalinks when switching themes 
function portfolio_rewrite_flush() {
    fwd_register_custom_post_types();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'portfolio_rewrite_flush' );