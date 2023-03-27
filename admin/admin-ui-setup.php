<?php
/**
 * Admin setup for the plugin
 *
 * @since 1.0
 * @function	bookingit_add_menu_links()		Add admin menu pages
 * @function	bookingit_register_settings	Register Settings
 * @function	bookingit_validater_and_sanitizer()	Validate And Sanitize User Input Before Its Saved To Database
 * @function	bookingit_get_settings()		Get settings from database
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

if ( ! defined( 'BOOKINGIT_MENU_PAGE_SLUG')) define('BOOKINGIT_MENU_PAGE_SLUG', 'toplevel_page_bookingit');

/**
 * Add admin menu pages
 *
 * @since 1.0
 * @refer https://developer.wordpress.org/plugins/administration-menus/
 */
function bookingit_register_my_custom_menu_page() {
	add_menu_page(
		__( 'BookingIt', 'bookingit' ),
		'BookingIt',
		'manage_options',
		'bookingit',
		'bookingit_admin_interface_render',
		'dashicons-calendar-alt',
		6
	);
}
add_action( 'admin_menu', 'bookingit_register_my_custom_menu_page' );

/**
 * Register Settings
 *
 * @since 1.0
 */
function bookingit_register_settings() {

	// Register Setting
	register_setting( 
		'bookingit_settings_group', 			// Group name
		'bookingit_settings', 					// Setting name = html form <input> name on settings form
		'bookingit_validater_and_sanitizer'	        // Input sanitizer
	);
	
	// Register A New Section
    add_settings_section(
        'bookingit_general_settings_section',							// ID
        __('General Settings', 'bookingit'),		// Title
        'bookingit_general_settings_section_callback',					// Callback Function
        'bookingit'											// Page slug
    );

	// General Settings
    add_settings_field(
        'bookingit_venue_slug',							// ID
        __('Venue Slug', 'bookingit'),					// Title
        'bookingit_general_settings_field_callback',			// Callback function
        'bookingit',											// Page slug
		'bookingit_general_settings_section'							// Settings Section ID
    );
	
}
add_action( 'admin_init', 'bookingit_register_settings' );

/**
 * Validate and sanitize user input before its saved to database
 *
 * @since 1.0
 */
function bookingit_validater_and_sanitizer ( $settings ) {
	// Sanitize text field
	$settings['bookingit_venue_slug'] = sanitize_text_field($settings['bookingit_venue_slug']);

	return $settings;
}
			
/**
 * Get settings from database
 *
 * @return	Array	A merged array of default and settings saved in database. 
 *
 * @since 1.0
 */
function bookingit_get_settings() {
	$defaults = array();

	$settings = get_option('bookingit_settings', $defaults);
	
	return $settings;
}

/**
 * Enqueue Admin CSS and JS
 *
 * @since 1.0
 */
function bookingit_enqueue_css_js( $hook ) {
    // Load only on BookingIt Plugin plugin pages
	if ( $hook !== BOOKINGIT_MENU_PAGE_SLUG ) {
		return;
	}
	
	// Main CSS
	 wp_enqueue_style( 'bookingit-admin-main-css', BOOKINGIT_STARTER_PLUGIN_URL . 'admin/css/main.css', '', BOOKINGIT_VERSION_NUM );
	
	// Main JS
     wp_enqueue_script( 'bookingit-admin-main-js', BOOKINGIT_STARTER_PLUGIN_URL . 'admin/js/main.js', array( 'jquery' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'bookingit_enqueue_css_js' );