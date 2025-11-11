<?php
// =============================================================
//  Custom Post Type: Testimonials
// =============================================================

function sanaportfolio_register_testimonials_cpt() {

    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name', 'sanaportfolio' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name', 'sanaportfolio' ),
        'menu_name'          => _x( 'Testimonials', 'admin menu', 'sanaportfolio' ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'sanaportfolio' ),
        'add_new'            => _x( 'Add New', 'testimonial', 'sanaportfolio' ),
        'add_new_item'       => __( 'Add New Testimonial', 'sanaportfolio' ),
        'new_item'           => __( 'New Testimonial', 'sanaportfolio' ),
        'edit_item'          => __( 'Edit Testimonial', 'sanaportfolio' ),
        'view_item'          => __( 'View Testimonial', 'sanaportfolio' ),
        'all_items'          => __( 'All Testimonials', 'sanaportfolio' ),
        'search_items'       => __( 'Search Testimonials', 'sanaportfolio' ),
        'not_found'          => __( 'No testimonials found.', 'sanaportfolio' ),
        'not_found_in_trash' => __( 'No testimonials found in Trash.', 'sanaportfolio' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-testimonial',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'       => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'testimonials' ),
    );

    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'sanaportfolio_register_testimonials_cpt' );

// =============================================================
//  Create default testimonials on theme activation
// =============================================================


function sanaportfolio_create_default_testimonials() {
    if ( get_option( 'sanaportfolio_default_testimonials_created' ) ) {
        return;
    }

    $default_testimonials = array(
        array(
            'title'   => 'Sarah Johnson',
            'content' => '“Jabran delivered beyond expectations! The website looks stunning and performs flawlessly.”',
            'image' => 'clinet1.jpg'
        ),
        array(
            'title'   => 'Michael Smith',
            'content' => '“Professional, responsive, and highly skilled in front-end and WordPress development.”',
            'image' => 'client2.jpg'
        ),
        array(
            'title'   => 'Emily Davis',
            'content' => '“His eye for design and attention to detail made all the difference in our project.”',
            'image' => 'client3.jpg'
        ),
    );

    foreach ( $default_testimonials as $testimonial ) {
        wp_insert_post( array(
            'post_title'   => $testimonial['title'],
            'post_content' => $testimonial['content'],
            'post_type'    => 'testimonial',
            'post_status'  => 'publish',
        ) );
    }

    update_option( 'sanaportfolio_default_testimonials_created', true );
}
add_action( 'after_switch_theme', 'sanaportfolio_create_default_testimonials' );
