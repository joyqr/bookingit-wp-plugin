<?php
/**
 * Admin UI setup and render
 *
 * @since 1.0
 * @function	bi_general_settings_section_callback()	Callback function for General Settings section
 * @function	bi_general_settings_field_callback()	Callback function for General Settings field
 * @function	bi_admin_interface_render()				Admin interface renderer
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Callback function for General Settings section
 *
 * @since 1.0
 */
function bi_general_settings_section_callback() {
	echo '<p>' . __('Please paste in the group ID from the settings page found in your BookingIt account', 'bookingit') . '</p>';
}

/**
 * Callback function for General Settings field
 *
 * @since 1.0
 */
function bi_general_settings_field_callback() {

	// Get Settings
	$settings = bi_get_settings();

	// General Settings. Name of form element should be same as the setting name in register_setting(). ?>
	
	<fieldset>
	
		<!-- Text Input -->
		<input type="text" name="bi_settings[bi_venue_id]" class="regular-text" value="<?php if ( isset( $settings['bi_venue_id'] ) && ( ! empty($settings['bi_venue_id']) ) ) echo esc_attr($settings['bi_venue_id']); ?>"/>
        {image of the settings page with venue ID}
	</fieldset>
	<?php
}
 
/**
 * Admin interface renderer
 *
 * @since 1.0
 */ 
function bi_admin_interface_render () {
	
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	/**
	 * If settings are inside WP-Admin > Settings, then WordPress will automatically display Settings Saved. If not used this block
	 * @refer	https://core.trac.wordpress.org/ticket/31000
	 * If the user have submitted the settings, WordPress will add the "settings-updated" $_GET parameter to the url
	 *
	if ( isset( $_GET['settings-updated'] ) ) {
		// Add settings saved message with the class of "updated"
		add_settings_error( 'bi_settings_saved_message', 'bi_settings_saved_message', __( 'Settings are Saved', 'bookingit' ), 'updated' );
	}
 
	// Show Settings Saved Message
	settings_errors( 'bi_settings_saved_message' ); */?>
	
	<div class="wrap">	
		<h1>BookingIt</h1>
		
		<form action="options.php" method="post">		
			<?php
			// Output nonce, action, and option_page fields for a settings page.
			settings_fields( 'bi_settings_group' );

			// Prints out all settings sections added to a particular settings page. 
			do_settings_sections( 'bookingit' );	// Page slug
			?>
            {short_code}
            {script for debug}
            {supported page builders WP Block, Elementor, Bakery}
			<?php
			// Output save settings button
			submit_button( __('Save Settings', 'bookingit') );
			?>
		</form>
	</div>
	<?php
}