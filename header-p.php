<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); // required to load styles, scripts, customizer preview etc. ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

<header class="site-header">
    <div class="main-header">
        <div class="main-top-bar">
            <div class="inner">
                <div class="left-top-bar">
                    <p>Call Us Now:<?php echo esc_html( get_option( 'sanaportfolio_phone' ) ); ?></p>
                </div>
                <div class="right-top-bar">
                    <!-- <p>Temp Header for testing</p> -->
                     <button class="contact-btn-hd">
                        Contact ME
                     </button>
                </div>

            </div>

        </div>
        <div class="main-menu-bar">
            <div class="menu-bar">
                <div>
                    <img src="<?php echo esc_url( get_option( 'sanaportfolio_logo' ) ); ?>" alt="Logo">
                </div>
                <button class="menu-toggle" aria-label="Toggle menu">☰</button>
                <nav class="main-navigation" role="navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary', // same location you registered in functions.php
                        'container'      => false,
                        'menu_class'     => 'primary-menu',
                        'fallback_cb'    => false,
                    ) );
                    ?>
                </nav>
            </div>
        </div>
    
    </div>
    
</header>
