<?php
// functions.php - theme bootstrap

if ( ! function_exists( 'sanaportfolio_setup' ) ) {
    function sanaportfolio_setup() {
        // Load translation files from /languages
        load_theme_textdomain( 'sanaportfolio', get_template_directory() . '/languages' );

        // Let WP manage the document title <title>
        add_theme_support( 'title-tag' );

        // RSS feed links in head
        add_theme_support( 'automatic-feed-links' );

        // Featured images
        add_theme_support( 'post-thumbnails' );

        // HTML5 markup for forms, gallery, etc.
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

        // Custom Logo support
        add_theme_support( 'custom-logo', array(
            'height'      => 60,
            'width'       => 200,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

        // Register menus
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'sanaportfolio' ),
            'footer'  => __( 'Footer Menu', 'sanaportfolio' ),
        ) );
    }
}
add_action( 'after_setup_theme', 'sanaportfolio_setup' );




/**
 * ----------------------------------------------------------------------------
 * --------------New Page Based styling i.e CSS and JS files enque code--------
 * ----------------------------------------------------------------------------
 */
// Additional page-specific styles

function sanaportfolio_enqueue_assets() {
    // It loads Main stylesheet i.e style.css
    wp_enqueue_style( 'sanaportfolio-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Header styles (all pages)
    wp_enqueue_style(
        'sanaportfolio-header-style',
        get_template_directory_uri() . '/assets/css/header.css',
        array(),
        filemtime( get_template_directory() . '/assets/css/header.css' )
    );

    // Sidebar styles (for all pages)
    wp_enqueue_style(
        'sanaportfolio-sidebar-style',
        get_template_directory_uri() . '/assets/css/sidebar.css',
        array(),
        filemtime( get_template_directory() . '/assets/css/sidebar.css' )
    );

    // Home page specific styles
    if ( is_front_page() ) {
        wp_enqueue_style(
            'sanaportfolio-home-style',
            get_template_directory_uri() . '/assets/css/home.css',
            array(),
            filemtime( get_template_directory() . '/assets/css/home.css' )
        );
    }



    // Sidebar JS
    wp_enqueue_script(
        'sanaportfolio-sidebar-js',
        get_template_directory_uri() . '/assets/js/sidebar.js',
        array(),
        filemtime( get_template_directory() . '/assets/js/sidebar.js' ),
        true
    );

    wp_enqueue_script(
        'sanaportfolio-customizer-preview',
        get_template_directory_uri() . '/js/customizer-live.js',
        array('customizer-live'),
        null,
        true
    );

    // Home page JS (animations, interactions)
if ( is_front_page() ) {
    wp_enqueue_script(
        'sanaportfolio-home-js',
        get_template_directory_uri() . '/assets/js/home.js',
        array(),
        filemtime( get_template_directory() . '/assets/js/home.js' ),
        true
    );
}



}
add_action( 'wp_enqueue_scripts', 'sanaportfolio_enqueue_assets' );

function sanaportfolio_customizer_live_preview() {
    wp_enqueue_script(
        'sanaportfolio-customizer-live',
        get_template_directory_uri() . '/assets/js/customizer-live.js',
        array('customize-preview'),
        filemtime(get_template_directory() . '/assets/js/customizer-live.js'),
        true
    );
}
add_action('customize_preview_init', 'sanaportfolio_customizer_live_preview');



/**
 * ----------------------------------------------------------------------------
 * --------------Register Widget areas-----------------------------------------
 * ----------------------------------------------------------------------------
 */
/* Register widget area(s) */
function sanaportfolio_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'sanaportfolio' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Main sidebar shown on blog pages.', 'sanaportfolio' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'sanaportfolio_widgets_init' );


/* Include Customizer controls (we put customizer code into inc/customizer.php) */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/theme-settings.php';
require get_template_directory() . '/inc/cpt-services.php';
require get_template_directory() . '/inc/cpt-portfolio.php';
require get_template_directory() . '/inc/cpt-testimonials.php';



