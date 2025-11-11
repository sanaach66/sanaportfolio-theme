<?php
/**
 * ============================================================
 *  Custom Post Type: Services
 * ============================================================
 */

if ( ! defined( 'ABSPATH' ) ) exit; // 🔒 Security check

// ------------------------------------------------------------
// 1️⃣ Register "Services" Custom Post Type
// ------------------------------------------------------------
function sanaportfolio_register_services_cpt() {

    $labels = array(
        'name'               => __( 'Services', 'sanaportfolio' ),
        'singular_name'      => __( 'Service', 'sanaportfolio' ),
        'menu_name'          => __( 'Services', 'sanaportfolio' ),
        'name_admin_bar'     => __( 'Service', 'sanaportfolio' ),
        'add_new'            => __( 'Add New', 'sanaportfolio' ),
        'add_new_item'       => __( 'Add New Service', 'sanaportfolio' ),
        'new_item'           => __( 'New Service', 'sanaportfolio' ),
        'edit_item'          => __( 'Edit Service', 'sanaportfolio' ),
        'view_item'          => __( 'View Service', 'sanaportfolio' ),
        'all_items'          => __( 'All Services', 'sanaportfolio' ),
        'search_items'       => __( 'Search Services', 'sanaportfolio' ),
        'not_found'          => __( 'No services found.', 'sanaportfolio' ),
        'not_found_in_trash' => __( 'No services found in Trash.', 'sanaportfolio' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-hammer', // 🧰 you can change this
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'services' ),
        'show_in_rest'       => true, // Gutenberg support
    );

    register_post_type( 'service', $args );
}
add_action( 'init', 'sanaportfolio_register_services_cpt' );


// ------------------------------------------------------------
// 2️⃣ Add Meta Box for Icon (Emoji or short text)
// ------------------------------------------------------------
function sanaportfolio_add_service_meta_box() {
    add_meta_box(
        'sanaportfolio_service_icon',
        __( 'Service Icon', 'sanaportfolio' ),
        'sanaportfolio_service_icon_callback',
        'service',
        'side'
    );
}
add_action( 'add_meta_boxes', 'sanaportfolio_add_service_meta_box' );

function sanaportfolio_service_icon_callback( $post ) {
    $value = get_post_meta( $post->ID, '_service_icon', true );
    ?>
    <label for="sanaportfolio_service_icon_field"><?php _e( 'Enter emoji or icon shortcode (e.g. 💻 or 🎨)', 'sanaportfolio' ); ?></label>
    <input 
        type="text" 
        id="sanaportfolio_service_icon_field" 
        name="sanaportfolio_service_icon_field" 
        value="<?php echo esc_attr( $value ); ?>" 
        style="width:100%; margin-top:8px;"
    />
    <?php
}

// ------------------------------------------------------------
// 3️⃣ Save Meta Box Data
// ------------------------------------------------------------
function sanaportfolio_save_service_meta( $post_id ) {
    if ( array_key_exists( 'sanaportfolio_service_icon_field', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_service_icon',
            sanitize_text_field( $_POST['sanaportfolio_service_icon_field'] )
        );
    }
}
add_action( 'save_post', 'sanaportfolio_save_service_meta' );

// ------------------------------------------------------------
// 4 adding default 3 services when theme is activated
// ------------------------------------------------------------


// inc/cpt-services.php

function sanaportfolio_seed_default_services() {
    // Check if there are already any service posts
    $existing = get_posts([
        'post_type'      => 'service',
        'posts_per_page' => 1,
    ]);

    if ( $existing ) {
        return; // ✅ Do nothing if user already has services
    }

    // Default services data
    $default_services = [
        [
            'title' => 'Web Development',
            'content' => 'I build fast, modern, and SEO-optimized WordPress websites that look great on every device.',
            'icon' => '💻',
        ],
        [
            'title' => 'UI/UX Design',
            'content' => 'I create clean and minimal user interfaces focused on usability and aesthetic balance.',
            'icon' => '🎨',
        ],
        [
            'title' => 'Custom Theme Development',
            'content' => 'From concept to code — I develop bespoke WordPress themes that are lightweight and scalable.',
            'icon' => '⚙️',
        ],
    ];

    // Insert each service post
    foreach ( $default_services as $service ) {
        $post_id = wp_insert_post([
            'post_title'   => wp_strip_all_tags( $service['title'] ),
            'post_content' => $service['content'],
            'post_status'  => 'publish',
            'post_type'    => 'service',
        ]);

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_service_icon', $service['icon'] );
        }
    }
}
add_action( 'after_switch_theme', 'sanaportfolio_seed_default_services' );