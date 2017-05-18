<?php

/**
 * Prevent Direct Access
 *
 * @since 0.1
 */
defined('ABSPATH') or die("Restricted access!");

/**
 * Register text domain
 *
 * @since 2.2
 */
function MCFunctions_textdomain() {
    load_plugin_textdomain( MCFUNC_TEXT, false, MCFUNC_DIR . '/languages/' );
}
add_action( 'init', 'MCFunctions_textdomain' );

/**
 * Print direct link to plugin admin page
 *
 * Fetches array of links generated by WP Plugin admin page ( Deactivate | Edit )
 * and inserts a link to the plugin admin page
 *
 * @since  2.2
 * @param  array $links Array of links generated by WP in Plugin Admin page.
 * @return array        Array of links to be output on Plugin Admin page.
 */
function MCFunctions_settings_link( $links ) {
    $page = '<a href="' . admin_url( 'themes.php?page=my-custom-functions.php' ) .'">' . __( 'Settings', MCFUNC_TEXT ) . '</a>';
    array_unshift( $links, $page );
    return $links;
}
add_filter( 'plugin_action_links_'.MCFUNC_BASE, 'MCFunctions_settings_link' );

/**
 * Print link to My Custom Functions PRO page
 *
 * @since 4.0
 */
function MCFunctions_upgrade_link( $links ) {
    $upgrade_page = '<a href="//www.arthurgareginyan.com/plugin-my-custom-functions-pro.html" target="_blank"><b style="color:red;">' . __( 'Upgrade to PRO', MCFUNC_TEXT ) . '</b></a>';
    array_unshift( $links, $upgrade_page );
    return $links;
}
add_filter( 'plugin_action_links_'.MCFUNC_BASE, 'MCFunctions_upgrade_link' );

/**
 * Print additional links to plugin meta row
 *
 * @since 4.0
 */
function MCFunctions_plugin_row_meta( $links, $file ) {

    if ( strpos( $file, 'my-custom-functions.php' ) !== false ) {

        $new_links = array(
                           'donate' => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8A88KC7TFF6CS" target="_blank"><span class="dashicons dashicons-heart"></span> ' . __( 'Donate', MCFUNC_TEXT ) . '</a>',
                           'upgrage' => '<a href="//www.arthurgareginyan.com/plugin-my-custom-functions-pro.html" target="_blank"><span class="dashicons dashicons-star-filled"></span> ' . __( 'Upgrade to PRO', MCFUNC_TEXT ) . '</a>'
                           );
        $links = array_merge( $links, $new_links );
    }

    return $links;
}
add_filter( 'plugin_row_meta', 'MCFunctions_plugin_row_meta', 10, 2 );

/**
 * Register plugin's submenu in the "Appearance" Admin Menu
 *
 * @since 4.0
 */
function MCFunctions_register_submenu_page() {
    add_theme_page( __( 'My Custom Functions', MCFUNC_TEXT ), __( 'Custom Functions', MCFUNC_TEXT ), 'edit_theme_options', 'my-custom-functions', 'MCFunctions_render_submenu_page' );
}
add_action( 'admin_menu', 'MCFunctions_register_submenu_page' );

/**
 * Register settings
 *
 * @since 4.0
 */
function MCFunctions_register_settings() {
    register_setting( 'anarcho_cfunctions_settings_group', 'anarcho_cfunctions_settings' );
    register_setting( 'anarcho_cfunctions_settings_group', 'anarcho_cfunctions_service_info' );
    register_setting( 'anarcho_cfunctions_settings_group', 'anarcho_cfunctions_error' );
}
add_action( 'admin_init', 'MCFunctions_register_settings' );
