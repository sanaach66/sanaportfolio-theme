<!-- <footer class="site-footer">
    <?php
    // Footer text from Customizer
    //$footer_text = get_theme_mod( 'sanaportfolio_footer_text', '' );
   // echo '<div class="site-footer-text">' . esc_html( $footer_text ) . '</div>';
    ?>

    <?php //wp_footer(); // required for plugins & scripts ?>
</footer>
</body>
</html> -->
<footer class="site-footer">
  <div class="footer-inner">
    <!-- Left: Logo or Site Name -->
    <div class="footer-brand">
      <?php if ( get_option('sanaportfolio_logo') ) : ?>
        <a href="<?php echo esc_url( home_url('/') ); ?>">
          <img src="<?php echo esc_url( get_option('sanaportfolio_logo') ); ?>" alt="<?php bloginfo('name'); ?>">
        </a>
      <?php else : ?>
        <h2><?php bloginfo('name'); ?></h2>
      <?php endif; ?>
    </div>

    <!-- Center: Navigation -->
    <div class="footer-menu">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'footer',
          'menu_class'     => 'footer-nav',
          'container'      => false,
        ) );
      ?>
    </div>

    <!-- Right: Contact or Social -->
    <div class="footer-contact">
      <p><?php echo esc_html( get_option( 'sanaportfolio_phone' ) ); ?></p>
      <p><?php echo esc_html( get_option( 'sanaportfolio_email' ) ); ?></p>
    </div>
  </div>

  <!-- Bottom Line -->
  <div class="footer-bottom">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
  </div>

  <?php wp_footer(); ?>
</footer>
</body>
</html>
