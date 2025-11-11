<?php
/**
 * The sidebar template.
 * Displays the fixed left sidebar with logo, menu, and contact info.
 */
?>

<aside class="sidebar">
    <div class="sidebar-inner">
        
        <!-- Site Logo -->
        <div class="sidebar-logo">
            <?php if ( get_option('sanaportfolio_logo') ) : ?>
                <a href="<?php echo esc_url( home_url('/') ); ?>">
                    <img src="<?php echo esc_url( get_option('sanaportfolio_logo') ); ?>" alt="<?php bloginfo('name'); ?>">
                </a>
            <?php else : ?>
                <h2><?php bloginfo('name'); ?></h2>
            <?php endif; ?>
        </div>

        <!-- Sidebar Toggle (for mobile view) -->
        <button class="sidebar-toggle" aria-label="Toggle Sidebar">☰</button>

        <!-- Navigation Menu -->
        <nav class="sidebar-menu">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                ) );
            ?>
        </nav>

        <!-- Footer Info (Phone & Email) -->
        <div class="sidebar-footer">
            <?php if ( get_option( 'sanaportfolio_phone' ) ) : ?>
                <p><?php echo esc_html( get_option( 'sanaportfolio_phone' ) ); ?></p>
            <?php endif; ?>

            <?php if ( get_option( 'sanaportfolio_email' ) ) : ?>
                <p><?php echo esc_html( get_option( 'sanaportfolio_email' ) ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</aside>
