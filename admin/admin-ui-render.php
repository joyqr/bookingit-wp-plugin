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
			<?php
			// Output nonce, action, and option_page fields for a settings page.
			settings_fields( 'bi_settings_group' );
?>

        <?php
			// Prints out all settings sections added to a particular settings page. 
			do_settings_sections( 'bookingit' );	// Page slug
			?>
            <table class="form-table bi-info">
                <tbody>
                    <tr>
                        <th><?php esc_html_e('Shortcode', 'bookingit'); ?></th>
                        <td>
                            <div>
                                <input type="text" id="bi-shortcode" disabled value="<?php echo BI_SHORTCODE; ?>" />
                                <button id="bi-copy-shortcode" type="button" aria-label="<?php esc_html_e('Copy shortcode to clipboard', 'bookingit'); ?>">
                                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="clipboard-list"  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M280 240H168c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0 96H168c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zM112 232c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zM336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM192 48c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16 7.2-16 16-16zm144 408c0 4.4-3.6 8-8 8H56c-4.4 0-8-3.6-8-8V120c0-4.4 3.6-8 8-8h40v32c0 8.8 7.2 16 16 16h160c8.8 0 16-7.2 16-16v-32h40c4.4 0 8 3.6 8 8v336z"></path></svg>
                                    <?php esc_html_e('Copy Shortcode', 'bookingit');  ?>
                                </button>
                            </div>
                            <p class="description"><?php esc_html_e('You can use shortcode to add booking form with any page builder using its shortcode widget', 'bookingit'); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

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