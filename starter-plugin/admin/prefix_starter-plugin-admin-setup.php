<?php
/**
 * Admin setup for the plugin
 *
 * @since 1.0
 * @function	prefix_add_menu_links()		Add admin menu pages
 * @function	prefix_register_settings	Register Settings
 * @function	prefix_validater_and_sanitizer()	Validate And Sanitize User Input Before Its Saved To Database
 */


// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;
 
 
/**
 * Add admin menu pages
 *
 * @since 	1.0
 * @refer	https://developer.wordpress.org/plugins/administration-menus/
 */
function prefix_add_menu_links() {
	add_options_page ( __('Starter Plugin','abl_prefix_td'), __('Starter Plugin','abl_prefix_td'), 'update_core', 'starter-plugin','prefix_admin_interface_render'  );
}
add_action( 'admin_menu', 'prefix_add_menu_links' );


/**
 * Register Settings
 *
 * @since 	1.0
 */
function prefix_register_settings() {

	// Register Setting
	register_setting( 
		'prefix_settings_group', 			// Group name
		'prefix_settings', 					// Setting name = html form <input> name on settings form
		'prefix_validater_and_sanitizer'	// Input sanitizer
	);
	
	// Register A New Section
    add_settings_section(
        'prefix_general_settings_section',							// ID
        __('Starter Plugin General Settings', 'abl_prefix_td'),		// Title
        'prefix_general_settings_section_callback',					// Callback Function
        'starter-plugin'											// Page slug
    );
	
	// General Settings
    add_settings_field(
        'prefix_general_settings_field',							// ID
        __('General Settings', 'abl_prefix_td'),					// Title
        'prefix_general_settings_field_callback',					// Callback function
        'starter-plugin',											// Page slug
        'prefix_general_settings_section'							// Settings Section ID
    );
	
}
add_action( 'admin_init', 'prefix_register_settings' );

/**
 * Validate And Sanitize User Input Before Its Saved To Database
 *
 * @since 		1.0
 */
function prefix_validater_and_sanitizer ( $input ) {
	return $input;
}


/**
 * Set default values for settings
 *
 * @since 	1.0
 */
// Default Values For Settings
$defaults = array(
				'setting_one' 	=> '1',
				'setting_two' 	=> '1',
			);

?>