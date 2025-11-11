<?php
// inc/theme-settings.php

// Add admin menu
function sanaportfolio_add_theme_settings_page() {
    add_menu_page(
        __( 'Theme Settings', 'sanaportfolio' ), // Page title
        __( 'Theme Settings', 'sanaportfolio' ), // Menu title
        'manage_options',                        // Capability
        'sanaportfolio-theme-settings',          // Slug
        'sanaportfolio_render_settings_page',    // Callback function
        'dashicons-admin-generic',               // Icon
        60                                       // Position
    );
}
add_action( 'admin_menu', 'sanaportfolio_add_theme_settings_page' );

// Register settings
function sanaportfolio_register_settings() {
    register_setting( 'sanaportfolio_settings_group', 'sanaportfolio_phone' );
    register_setting( 'sanaportfolio_settings_group', 'sanaportfolio_email' );
    register_setting( 'sanaportfolio_settings_group', 'sanaportfolio_address' );
    register_setting( 'sanaportfolio_settings_group', 'sanaportfolio_logo' );
}
add_action( 'admin_init', 'sanaportfolio_register_settings' );

// 3️⃣ Enqueue admin scripts and styles
function sanaportfolio_enqueue_admin_assets( $hook ) {
    if ( $hook !== 'toplevel_page_sanaportfolio-theme-settings' ) {
        return;
    }

    // WordPress media uploader (for logo)
    wp_enqueue_media();

    // Custom admin JS (no jQuery)
    wp_enqueue_script(
        'sanaportfolio-admin-script',
        get_template_directory_uri() . '/assets/js/admin-theme-settings.js',
        array(),
        false,
        true
    );

    // Custom admin CSS
    wp_enqueue_style(
        'sanaportfolio-admin-style',
        get_template_directory_uri() . '/assets/css/admin-theme-settings.css'
    );
}
add_action( 'admin_enqueue_scripts', 'sanaportfolio_enqueue_admin_assets' );


// Render admin page
function sanaportfolio_render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e( 'Theme Settings', 'sanaportfolio' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'sanaportfolio_settings_group' ); ?>
            <?php do_settings_sections( 'sanaportfolio_settings_group' ); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e( 'Phone Number', 'sanaportfolio' ); ?></th>
                    <td><input type="text" name="sanaportfolio_phone" value="<?php echo esc_attr( get_option('sanaportfolio_phone') ); ?>" class="regular-text" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e( 'Email Address', 'sanaportfolio' ); ?></th>
                    <td><input type="email" name="sanaportfolio_email" value="<?php echo esc_attr( get_option('sanaportfolio_email') ); ?>" class="regular-text" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e( 'Address', 'sanaportfolio' ); ?></th>
                    <td><textarea name="sanaportfolio_address" rows="3" class="regular-text"><?php echo esc_textarea( get_option('sanaportfolio_address') ); ?></textarea></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e( 'Logo', 'sanaportfolio' ); ?></th>
                    <td>
                        <input type="text" 
                               id="sanaportfolio_logo" 
                               name="sanaportfolio_logo" 
                               value="<?php echo esc_attr( get_option( 'sanaportfolio_logo' ) ); ?>" 
                               class="regular-text" />

                        <button type="button" 
                                class="button" 
                                id="sanaportfolio_upload_logo_btn">
                            <?php _e( 'Upload Logo', 'sanaportfolio' ); ?>
                        </button>

                        <div class="logo-preview" id="sanaportfolio_logo_preview"></div>
                    </td>
                </tr>


            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
