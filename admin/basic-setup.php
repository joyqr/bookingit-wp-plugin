<?php 
/**
 * Basic setup functions for the plugin
 *
 * @since 1.0
 * @function	bookingit_activate_plugin()		Plugin activatation todo list
 * @function	bookingit_load_plugin_textdomain()	Load plugin text domain
 * @function	bookingit_settings_link()			Print direct link to plugin settings in plugins list in admin
 * @function	bookingit_plugin_row_meta()		Add donate and other links to plugins list
 * @function	bookingit_footer_text()			Admin footer text
 * @function	bookingit_footer_version()			Admin footer version
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
 
/**
 * Plugin activatation todo list
 *
 * This function runs when user activates the plugin. Used in register_activation_hook in the main plugin file. 
 * @since 1.0
 */
function bookingit_activate_plugin() {
	
}

/**
 * Load plugin text domain
 *
 * @since 1.0
 */
function bookingit_load_plugin_textdomain() {
    load_plugin_textdomain( 'bookingit', false, '/bookingit/languages/' );
}
add_action( 'plugins_loaded', 'bookingit_load_plugin_textdomain' );

/**
 * Print direct link to plugin settings in plugins list in admin
 *
 * @since 1.0
 */
function bookingit_settings_link( $links ) {
	return array_merge(
		array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=bookingit' ) . '">' . __( 'Settings', 'bookingit' ) . '</a>'
		),
		$links
	);
}
add_filter( 'plugin_action_links_' . BOOKINGIT_STARTER_PLUGIN . '/bookingit.php', 'bookingit_settings_link' );

/**
 * Add donate and other links to plugins list
 *
 * @since 1.0
 */
function bookingit_plugin_row_meta( $links, $file ) {
	if ( strpos( $file, 'bookingit.php' ) !== false ) {
		$new_links = array(
				'example' 	=> '<a href="#" target="_blank">Text</a>',
				);
		$links = array_merge( $links, $new_links );
	}
	return $links;
}
//add_filter( 'plugin_row_meta', 'bookingit_plugin_row_meta', 10, 2 );

/**
 * Admin footer text
 *
 * A function to add footer text to the settings page of the plugin. Footer text contains plugin rating and donation links.
 * Note: Remove the rating link if the plugin doesn't have a WordPress.org directory listing yet. (i.e. before initial approval)
 *
 * @since 1.0
 * @refer https://codex.wordpress.org/Function_Reference/get_current_screen
 */
function bookingit_footer_text($default) {
    
	// Retun default on non-plugin pages
	$screen = get_current_screen();
	if ( $screen->id !== "settings_page_bookingit" ) {
		return $default;
	}
	
    $bookingit_footer_text = sprintf( __( 'If you like this plugin, please <a href="%s" target="_blank">make a donation</a> or leave me a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating to support continued development. Thanks a bunch!', 'bookingit' ),
								'http://millionclues.com/donate/',
								'https://wordpress.org/support/plugin/bookingit/reviews/?rate=5#new-post'
						);
	
	return $bookingit_footer_text;
}
//add_filter('admin_footer_text', 'bookingit_footer_text');

/**
 * Admin footer version
 *
 * @since 1.0
 */
function bookingit_footer_version($default) {
	
	// Retun default on non-plugin pages
	$screen = get_current_screen();
	if ( $screen->id !== 'settings_page_bookingit' ) {
		return $default;
	}
	
	return __('Plugin version ', 'bookingit') . BOOKINGIT_VERSION_NUM;
}
add_filter( 'update_footer', 'bookingit_footer_version', 11 );