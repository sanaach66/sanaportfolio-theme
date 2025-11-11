<?php
// inc/customizer.php

function sanaportfolio_customize_register( $wp_customize ) {

    // 1) Colors section
    $wp_customize->add_section( 'sanaportfolio_colors', array(
        'title'    => __( 'Colors', 'sanaportfolio' ),
        'priority' => 30,
    ) );

    // Header background color setting (sanitized)
    $wp_customize->add_setting( 'sanaportfolio_header_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color', // built-in WP sanitizer
    ) );

    // Color control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sanaportfolio_header_bg_control', array(
        'label'    => __( 'Header background', 'sanaportfolio' ),
        'section'  => 'sanaportfolio_colors',
        'settings' => 'sanaportfolio_header_bg',
    ) ) );


    // 2) Footer text
    $wp_customize->add_section( 'sanaportfolio_footer', array(
        'title' => __( 'Footer', 'sanaportfolio' ),
    ) );

    $wp_customize->add_setting( 'sanaportfolio_footer_text', array(
        'default'           => sprintf( __( '© %d My site', 'sanaportfolio' ), date( 'Y' ) ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'sanaportfolio_footer_text_control', array(
        'label'   => __( 'Footer text', 'sanaportfolio' ),
        'section' => 'sanaportfolio_footer',
        'settings'=> 'sanaportfolio_footer_text',
        'type'    => 'text',
    ) );


    // 3) Social link example
    $wp_customize->add_section( 'sanaportfolio_social', array(
        'title' => __( 'Social links', 'sanaportfolio' ),
    ) );

    $wp_customize->add_setting( 'sanaportfolio_twitter', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'sanaportfolio_twitter_control', array(
        'label'   => __( 'Twitter profile URL', 'sanaportfolio' ),
        'section' => 'sanaportfolio_social',
        'settings'=> 'sanaportfolio_twitter',
        'type'    => 'url',
    ) );
}
add_action( 'customize_register', 'sanaportfolio_customize_register' );


// =============================================================
//  Hero Section Customizer Settings
// =============================================================
function sanaportfolio_customize_register_hero( $wp_customize ) {

    // --- Panel/Section for Hero ---
    $wp_customize->add_section( 'sanaportfolio_hero_section', array(
        'title'       => __( 'Hero Section', 'sanaportfolio' ),
        'priority'    => 30,
        'description' => __( 'Edit the content of your homepage hero section.', 'sanaportfolio' ),
    ) );

    // --- Hero Title ---
    $wp_customize->add_setting( 'sanaportfolio_hero_title', array(
        'default'           => __( 'I’m Jabran Arshad — a Creative Developer & Designer', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage', // 👈 Enables live preview
    ) );

    $wp_customize->add_control( 'sanaportfolio_hero_title', array(
        'label'   => __( 'Hero Title', 'sanaportfolio' ),
        'section' => 'sanaportfolio_hero_section',
        'type'    => 'text',
    ) );

    // --- Hero Subtitle ---
    $wp_customize->add_setting( 'sanaportfolio_hero_subtitle', array(
        'default'           => __( 'I design and build modern web experiences that blend clarity, aesthetics, and performance.', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage', // 👈 Live preview
    ) );

    $wp_customize->add_control( 'sanaportfolio_hero_subtitle', array(
        'label'   => __( 'Hero Subtitle', 'sanaportfolio' ),
        'section' => 'sanaportfolio_hero_section',
        'type'    => 'text',
    ) );

    // --- Hero Button Text ---
    $wp_customize->add_setting( 'sanaportfolio_hero_btn_text', array(
        'default'           => __( 'View My Work', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'sanaportfolio_hero_btn_text', array(
        'label'   => __( 'Button Text', 'sanaportfolio' ),
        'section' => 'sanaportfolio_hero_section',
        'type'    => 'text',
    ) );

    // --- Hero Button Link ---
    $wp_customize->add_setting( 'sanaportfolio_hero_btn_link', array(
        'default'           => '#portfolio',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage', // 👈 optional (for instant href change)
    ) );

    $wp_customize->add_control( 'sanaportfolio_hero_btn_link', array(
        'label'   => __( 'Button Link', 'sanaportfolio' ),
        'section' => 'sanaportfolio_hero_section',
        'type'    => 'url',
    ) );

    // --- Background Image ---
    $wp_customize->add_setting( 'sanaportfolio_hero_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage', // 👈 allows live bg-image change
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sanaportfolio_hero_bg', array(
        'label'   => __( 'Background Image', 'sanaportfolio' ),
        'section' => 'sanaportfolio_hero_section',
    ) ) );
}
add_action( 'customize_register', 'sanaportfolio_customize_register_hero' );

// =============================================================
//  About Section Customizer Settings
// =============================================================
function sanaportfolio_customize_register_about( $wp_customize ) {

    $wp_customize->add_section( 'sanaportfolio_about_section', array(
        'title'       => __( 'About Section', 'sanaportfolio' ),
        'priority'    => 35,
        'description' => __( 'Edit the content of your About section.', 'sanaportfolio' ),
    ) );

    // --- Title ---
    $wp_customize->add_setting( 'sanaportfolio_about_title', array(
        'default'           => __( 'Who We Are', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'sanaportfolio_about_title', array(
        'label'   => __( 'Section Title', 'sanaportfolio' ),
        'section' => 'sanaportfolio_about_section',
        'type'    => 'text',
    ) );

    // --- Description ---
    $wp_customize->add_setting( 'sanaportfolio_about_text', array(
        'default'           => __( 'We are a creative agency passionate about crafting impactful digital experiences. Our team combines design, strategy, and technology to help brands stand out and grow.', 'sanaportfolio' ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'sanaportfolio_about_text', array(
        'label'   => __( 'Description', 'sanaportfolio' ),
        'section' => 'sanaportfolio_about_section',
        'type'    => 'textarea',
    ) );

    // --- Button Text ---
    $wp_customize->add_setting( 'sanaportfolio_about_btn_text', array(
        'default'           => __( 'Learn More', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'sanaportfolio_about_btn_text', array(
        'label'   => __( 'Button Text', 'sanaportfolio' ),
        'section' => 'sanaportfolio_about_section',
        'type'    => 'text',
    ) );

    // --- Button Link ---
    $wp_customize->add_setting( 'sanaportfolio_about_btn_link', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'sanaportfolio_about_btn_link', array(
        'label'   => __( 'Button Link', 'sanaportfolio' ),
        'section' => 'sanaportfolio_about_section',
        'type'    => 'url',
    ) );

    // --- Image ---
    $wp_customize->add_setting( 'sanaportfolio_about_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sanaportfolio_about_image', array(
        'label'   => __( 'About Image', 'sanaportfolio' ),
        'section' => 'sanaportfolio_about_section',
    ) ) );
}
add_action( 'customize_register', 'sanaportfolio_customize_register_about' );

// =============================================================
//  Services Section Customizer Settings
// =============================================================
function sanaportfolio_customize_register_services( $wp_customize ) {

    // --- Add Services Section ---
    $wp_customize->add_section( 'sanaportfolio_services_section', array(
        'title'       => __( 'Services Section', 'sanaportfolio' ),
        'priority'    => 40,
        'description' => __( 'Manage the services section displayed on the homepage.', 'sanaportfolio' ),
    ) );

    // --- Add Control for Number of Services to Show ---
    $wp_customize->add_setting( 'sanaportfolio_services_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'sanaportfolio_services_count', array(
        'label'       => __( 'Number of Services to Display', 'sanaportfolio' ),
        'section'     => 'sanaportfolio_services_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 6,
            'step' => 1,
        ),
    ) );

    // --- Section Title ---
    $wp_customize->add_setting( 'sanaportfolio_services_title', array(
        'default'           => __( 'What I Do', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'          => 'postMessage', // 👈 for live preview
    ) );

    $wp_customize->add_control( 'sanaportfolio_services_title', array(
        'label'   => __( 'Section Title', 'sanaportfolio' ),
        'section' => 'sanaportfolio_services_section',
        'type'    => 'text',
    ) );
}
add_action( 'customize_register', 'sanaportfolio_customize_register_services' );



// =============================================================
//  Portfolio Section - Customizer
// =============================================================

function sanaportfolio_customize_portfolio_section( $wp_customize ) {

    // === Section ===
    $wp_customize->add_section( 'sanaportfolio_portfolio_section', array(
        'title'       => __( 'Portfolio Section', 'sanaportfolio' ),
        'priority'    => 50,
        'description' => __( 'Manage portfolio section title and item count.', 'sanaportfolio' ),
    ) );

    // === Setting: Title ===
    $wp_customize->add_setting( 'sanaportfolio_portfolio_title', array(
        'default'           => __( 'My Work', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'sanaportfolio_portfolio_title', array(
        'label'   => __( 'Section Title', 'sanaportfolio' ),
        'section' => 'sanaportfolio_portfolio_section',
        'type'    => 'text',
    ) );

    // === Setting: Number of Items ===
    $wp_customize->add_setting( 'sanaportfolio_portfolio_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'sanaportfolio_portfolio_count', array(
        'label'   => __( 'Number of Portfolio Items', 'sanaportfolio' ),
        'section' => 'sanaportfolio_portfolio_section',
        'type'    => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 12,
            'step' => 1,
        ),
    ) );

}

add_action( 'customize_register', 'sanaportfolio_customize_portfolio_section' );

// =============================================================
//  Portfolio Section - Customizer
// =============================================================

function sanaportfolio_customize_testimonials_section( $wp_customize ) {

    $wp_customize->add_section( 'sanaportfolio_testimonials_section', array(
        'title'       => __( 'Testimonials Section', 'sanaportfolio' ),
        'priority'    => 60,
        'description' => __( 'Manage testimonial section title and number of items.', 'sanaportfolio' ),
    ) );

    // Section title
    $wp_customize->add_setting( 'sanaportfolio_testimonials_title', array(
        'default'           => __( 'What Clients Say', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'sanaportfolio_testimonials_title', array(
        'label'   => __( 'Section Title', 'sanaportfolio' ),
        'section' => 'sanaportfolio_testimonials_section',
        'type'    => 'text',
    ) );

    // Number of items
    $wp_customize->add_setting( 'sanaportfolio_testimonials_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'sanaportfolio_testimonials_count', array(
        'label'   => __( 'Number of Testimonials', 'sanaportfolio' ),
        'section' => 'sanaportfolio_testimonials_section',
        'type'    => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 12,
            'step' => 1,
        ),
    ) );
}
add_action( 'customize_register', 'sanaportfolio_customize_testimonials_section' );

// =============================================================
//  Blog Section - Customizer
// =============================================================
function sanaportfolio_customize_blog_section( $wp_customize ) {

    $wp_customize->add_section( 'sanaportfolio_blog_section', array(
        'title'       => __( 'Blog Section', 'sanaportfolio' ),
        'priority'    => 55,
        'description' => __( 'Customize the Blog section title and subtitle.', 'sanaportfolio' ),
    ) );

    // Title
    $wp_customize->add_setting( 'sanaportfolio_blog_title', array(
        'default'           => __( 'Latest Articles', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control( 'sanaportfolio_blog_title', array(
        'label'   => __( 'Section Title', 'sanaportfolio' ),
        'section' => 'sanaportfolio_blog_section',
        'type'    => 'text',
    ));

    // Subtitle
    $wp_customize->add_setting( 'sanaportfolio_blog_subtitle', array(
        'default'           => __( 'Insights, stories, and thoughts from our team', 'sanaportfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control( 'sanaportfolio_blog_subtitle', array(
        'label'   => __( 'Section Subtitle', 'sanaportfolio' ),
        'section' => 'sanaportfolio_blog_section',
        'type'    => 'text',
    ));

    // Number of posts to display
$wp_customize->add_setting( 'sanaportfolio_blog_count', array(
    'default'           => 3,
    'sanitize_callback' => 'absint',
    'transport'         => 'postMessage',
));

$wp_customize->add_control( 'sanaportfolio_blog_count', array(
    'label'       => __( 'Number of Posts to Show', 'sanaportfolio' ),
    'section'     => 'sanaportfolio_blog_section',
    'type'        => 'number',
    'input_attrs' => array(
        'min'  => 1,
        'max'  => 10,
        'step' => 1,
    ),
));

}
add_action( 'customize_register', 'sanaportfolio_customize_blog_section' );
