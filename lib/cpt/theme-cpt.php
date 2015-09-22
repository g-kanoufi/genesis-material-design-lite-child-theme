<?php

// Register Custom Post Type
// If you need any help doing this, just go on https://generatewp.com/post-type/
function custom_post_type() {

    $labels = array(
        'name'                => _x( 'Post Types', 'Post Type General Name', 'genesis-material-design-lite-child-theme' ),
        'singular_name'       => _x( 'Post Type', 'Post Type Singular Name', 'genesis-material-design-lite-child-theme' ),
        'menu_name'           => __( 'Post Type', 'genesis-material-design-lite-child-theme' ),
        'name_admin_bar'      => __( 'Post Type', 'genesis-material-design-lite-child-theme' ),
        'parent_item_colon'   => __( 'Parent Item:', 'genesis-material-design-lite-child-theme' ),
        'all_items'           => __( 'All Items', 'genesis-material-design-lite-child-theme' ),
        'add_new_item'        => __( 'Add New Item', 'genesis-material-design-lite-child-theme' ),
        'add_new'             => __( 'Add New', 'genesis-material-design-lite-child-theme' ),
        'new_item'            => __( 'New Item', 'genesis-material-design-lite-child-theme' ),
        'edit_item'           => __( 'Edit Item', 'genesis-material-design-lite-child-theme' ),
        'update_item'         => __( 'Update Item', 'genesis-material-design-lite-child-theme' ),
        'view_item'           => __( 'View Item', 'genesis-material-design-lite-child-theme' ),
        'search_items'        => __( 'Search Item', 'genesis-material-design-lite-child-theme' ),
        'not_found'           => __( 'Not found', 'genesis-material-design-lite-child-theme' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'genesis-material-design-lite-child-theme' ),
    );
    $args = array(
        'label'               => __( 'Post Type', 'genesis-material-design-lite-child-theme' ),
        'description'         => __( 'Post Type Description', 'genesis-material-design-lite-child-theme' ),
        'labels'              => $labels,
        'supports'            => array( ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'post_type', $args );

}
add_action( 'init', 'custom_post_type', 0 );
