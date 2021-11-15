<?php
/**
 * Admin setup for the plugin
 *
 * @since 1.0
 * @function	bi_add_menu_links()		Add admin menu pages
 * @function	bi_register_settings	Register Settings
 * @function	bi_validater_and_sanitizer()	Validate And Sanitize User Input Before Its Saved To Database
 * @function	bi_get_settings()		Get settings from database
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

if ( ! defined( 'BI_MENU_PAGE_SLUG' ) ) 		define( 'BI_MENU_PAGE_SLUG'		, 'toplevel_page_bookingit' );

/**
 * Add admin menu pages
 *
 * @since 1.0
 * @refer https://developer.wordpress.org/plugins/administration-menus/
 */
function bi_register_my_custom_menu_page() {
	add_menu_page(
		__( 'BookingIt', 'bookingit' ),
		'BookingIt',
		'manage_options',
		'bookingit',
		'bi_admin_interface_render',
		'dashicons-calendar-alt',
		6
	);
}
add_action( 'admin_menu', 'bi_register_my_custom_menu_page' );

/**
 * Register Settings
 *
 * @since 1.0
 */
function bi_register_settings() {

	// Register Setting
	register_setting( 
		'bi_settings_group', 			// Group name
		'bi_settings', 					// Setting name = html form <input> name on settings form
		'bi_validater_and_sanitizer'	// Input sanitizer
	);
	
	// Register A New Section
    add_settings_section(
        'bi_general_settings_section',							// ID
        __('General Settings', 'bookingit'),		// Title
        'bi_general_settings_section_callback',					// Callback Function
        'bookingit'											// Page slug
    );

	// General Settings
    add_settings_field(
        'bi_venue_id',							// ID
        __('Venue ID', 'bookingit'),					// Title
        'bi_general_settings_field_callback',			// Callback function
        'bookingit',											// Page slug
		'bi_general_settings_section'							// Settings Section ID
    );
	
}
add_action( 'admin_init', 'bi_register_settings' );

/**
 * Validate and sanitize user input before its saved to database
 *
 * @since 1.0
 */
function bi_validater_and_sanitizer ( $settings ) {
	// Sanitize text field
	$settings['bi_venue_id'] = sanitize_text_field($settings['bi_venue_id']);
	
	return $settings;
}
			
/**
 * Get settings from database
 *
 * @return	Array	A merged array of default and settings saved in database. 
 *
 * @since 1.0
 */
function bi_get_settings() {

	$defaults = array();

	$settings = get_option('bi_settings', $defaults);
	
	return $settings;
}

/**
 * Enqueue Admin CSS and JS
 *
 * @since 1.0
 */
function bi_enqueue_css_js( $hook ) {

    // Load only on BookingIt Plugin plugin pages
	if ( $hook !== BI_MENU_PAGE_SLUG ) {
		return;
	}
	
	// Main CSS
	 wp_enqueue_style( 'bi-admin-main-css', BI_STARTER_PLUGIN_URL . 'admin/css/main.css', '', BI_VERSION_NUM );
	
	// Main JS
     wp_enqueue_script( 'bi-admin-main-js', BI_STARTER_PLUGIN_URL . 'admin/js/main.js', array( 'jquery' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'bi_enqueue_css_js' );