<?php
// =============================================================
//  Register Custom Post Type: Portfolio
// =============================================================
function sanaportfolio_register_portfolio_cpt() {

    $labels = array(
        'name'               => __( 'Portfolio', 'sanaportfolio' ),
        'singular_name'      => __( 'Portfolio Item', 'sanaportfolio' ),
        'add_new'            => __( 'Add New Project', 'sanaportfolio' ),
        'add_new_item'       => __( 'Add New Portfolio Item', 'sanaportfolio' ),
        'edit_item'          => __( 'Edit Portfolio Item', 'sanaportfolio' ),
        'new_item'           => __( 'New Portfolio Item', 'sanaportfolio' ),
        'view_item'          => __( 'View Portfolio Item', 'sanaportfolio' ),
        'search_items'       => __( 'Search Portfolio', 'sanaportfolio' ),
        'not_found'          => __( 'No portfolio items found', 'sanaportfolio' ),
        'not_found_in_trash' => __( 'No portfolio items found in Trash', 'sanaportfolio' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'sanaportfolio_register_portfolio_cpt' );

// =============================================================
//  Add Default Portfolio Items on Theme Activation
// =============================================================
function sanaportfolio_insert_default_portfolio() {
    if ( get_option( 'sanaportfolio_demo_portfolio_created' ) ) return;

    $demo_projects = array(
        array(
            'title' => 'Corporate Website',
            'content' => 'Modern WordPress site with custom theme.',
            'image' => 'portfolio1.jpg'
        ),
        array(
            'title' => 'Brand Landing Page',
            'content' => 'High-converting design for digital products.',
            'image' => 'portfolio2.jpg'
        ),
        array(
            'title' => 'E-Commerce Store',
            'content' => 'WooCommerce-based minimalist store layout.',
            'image' => 'portfolio3.jpg'
        ),
    );

    foreach ( $demo_projects as $project ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $project['title'],
            'post_content' => $project['content'],
            'post_status'  => 'publish',
            'post_type'    => 'portfolio',
        ));

        if ( $post_id && !has_post_thumbnail( $post_id ) ) {
            $image_path = get_template_directory() . '/assets/images/' . $project['image'];
            if ( file_exists( $image_path ) ) {
                $image_url  = get_template_directory_uri() . '/assets/images/' . $project['image'];
                $upload_dir = wp_upload_dir();
                $image_data = file_get_contents( $image_path );
                $filename   = basename( $image_path );

                if ( wp_mkdir_p( $upload_dir['path'] ) ) {
                    $file = $upload_dir['path'] . '/' . $filename;
                } else {
                    $file = $upload_dir['basedir'] . '/' . $filename;
                }

                file_put_contents( $file, $image_data );

                $wp_filetype = wp_check_filetype( $filename, null );
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title'     => sanitize_file_name( $filename ),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );

                $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                wp_update_attachment_metadata( $attach_id, $attach_data );
                set_post_thumbnail( $post_id, $attach_id );
            }
        }
    }

    update_option( 'sanaportfolio_demo_portfolio_created', true );
}
add_action( 'after_switch_theme', 'sanaportfolio_insert_default_portfolio' );
