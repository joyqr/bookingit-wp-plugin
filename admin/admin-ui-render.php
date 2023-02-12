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
	return;
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
		<input type="text" name="bi_settings[bi_venue_slug]" class="regular-text" value="<?php if ( isset( $settings['bi_venue_slug'] ) && ( ! empty($settings['bi_venue_slug']) ) ) echo esc_attr($settings['bi_venue_slug']); ?>"/>
        <p class="description"><?php esc_html_e('Fill in the venue slug from BookingIt settings (example: my-awesome-restaurant)', 'bookingit'); ?></p>
        <p>
            <a href="https://bookingit.io/settings/booking-links/2" target="_blank" rel=”noopener”>Bookingit form setting</a>
        </p>
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
        <a href="https://bookingit.io" target="_blank" rel="noopener noreferrer">
            <svg width="142" height="32" viewBox="0 0 142 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M142 4H113V31H142V4Z" fill="#DA4D46"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M119.385 11.4682H123.981V8.29735H119.385V11.4682ZM123.981 13.5095H119.385V26.0228H123.981V13.5095Z" fill="white"/>
                <path d="M126.203 13.5091H128.91V10.6993L133.428 9.37879V13.5106H136.645V16.5367H133.428V21.149C133.428 22.6621 133.81 23.4305 135.267 23.4305C135.727 23.4305 136.212 23.3351 136.671 23.262L136.824 26.0717C135.956 26.1672 135.088 26.312 133.939 26.312C129.828 26.312 128.833 24.6064 128.833 21.628V16.5367H126.203V13.5091Z" fill="white"/>
                <path d="M79.3336 0L70.825 7.71151L66.7104 4.87341L64.6023 7.56528L69.9273 11.239L71.136 12.0626L72.2114 11.0928L81.7954 2.41134L79.3336 0Z" fill="#DA4D46"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 25.7818V7.68182H7.14597C10.5659 7.68182 12.8627 8.92927 12.8627 12.3866C12.8627 14.0191 12.3012 15.3396 10.7451 16.0843V16.132C13.502 16.4677 14.6742 18.221 14.6742 20.7412C14.6742 24.5344 11.2305 25.7818 7.70749 25.7818H0ZM5.00139 14.786H5.56291C6.889 14.786 8.26743 14.5697 8.26743 13.0342C8.26743 11.3779 6.71134 11.2824 5.35828 11.2824H5.00139V14.786ZM5.63905 22.1812H5.00139V18.2911H5.51215C5.64346 18.2911 5.78021 18.2897 5.92066 18.2883C7.52775 18.2718 9.62048 18.2505 9.62048 20.2608C9.62048 22.1873 7.28069 22.1837 5.78812 22.1814C5.73741 22.1813 5.68768 22.1812 5.63905 22.1812Z" fill="#3E444D"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24.0997 26.1898C28.3095 26.1898 31.9848 23.8128 31.9848 19.6362C31.9848 15.4357 28.3095 13.0587 24.0997 13.0587C19.8897 13.0587 16.2145 15.4357 16.2145 19.6362C16.2145 23.8366 19.9151 26.1898 24.0997 26.1898ZM24.0997 22.3967C22.212 22.3967 21.1144 21.197 21.1144 19.6362C21.1144 18.1246 22.212 16.8518 24.0997 16.8518C25.9873 16.8518 27.0849 18.1246 27.0849 19.6362C27.0849 21.197 25.9888 22.3967 24.0997 22.3967Z" fill="#3E444D"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M41.0024 26.1898C45.2122 26.1898 48.8875 23.8128 48.8875 19.6362C48.8875 15.4357 45.2138 13.0587 41.0024 13.0587C36.7924 13.0587 33.1172 15.4357 33.1172 19.6362C33.1172 23.8366 36.8178 26.1898 41.0024 26.1898ZM41.0024 22.3967C39.1148 22.3967 38.0171 21.197 38.0171 19.6362C38.0171 18.1246 39.1148 16.8518 41.0024 16.8518C42.89 16.8518 43.9876 18.1246 43.9876 19.6362C43.9876 21.197 42.8915 22.3967 41.0024 22.3967Z" fill="#3E444D"/>
                <path d="M55.6337 17.9088L60.4559 13.4666H66.8103L60.2528 19.1562L67.2196 25.7814H60.7113L55.6322 20.7632V25.7814H50.9877V5.85796H55.6322V17.9088H55.6337Z" fill="#3E444D"/>
                <path d="M73.1996 25.7827H68.5552V13.4678H73.1996V25.7827Z" fill="#3E444D"/>
                <path d="M80.9103 15.0526H80.9611C82.0334 13.5634 83.3356 13.0607 85.1455 13.0607C88.667 13.0607 90.0707 15.1497 90.0707 18.1743V25.7843H85.4262V19.7828C85.4262 18.607 85.6293 16.5419 83.334 16.5419C81.4449 16.5419 80.9087 17.8624 80.9087 19.3978V25.7843H76.2642V13.4695H80.9087V15.0526H80.9103Z" fill="#3E444D"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M99.9312 31.928C104.754 31.928 107.509 29.8151 107.509 24.582H107.508V13.4699H102.864V14.7665H102.813C101.895 13.543 100.491 13.0625 98.9595 13.0625C94.9547 13.0625 92.2485 16.1349 92.2485 19.7355C92.2485 23.2883 94.877 26.0249 98.7045 26.0249C100.441 26.0249 101.666 25.4714 102.865 24.3433V24.9193C102.865 26.9099 102.382 28.4467 99.8798 28.4467C99.4473 28.4467 98.9615 28.3498 98.5542 28.1587C98.1459 27.9663 97.8143 27.6544 97.6863 27.2232H92.4802C92.8879 30.4642 96.9201 31.928 99.9312 31.928ZM100.034 22.302C98.1459 22.302 97.0482 21.1008 97.0482 19.5415C97.0482 18.0284 98.145 16.7556 100.034 16.7556C101.921 16.7556 103.019 18.0284 103.019 19.5415C103.019 21.1024 101.921 22.302 100.034 22.302Z" fill="#3E444D"/>
            </svg>
        </a>
        <h1>BookingIt</h1>
        <form action="options.php" method="post">
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
<!--            <code>-->
<!--                --><?php
//                esc_html_e(bi_get_embed_html('test-slug'));
//                ?>
<!--            </code>-->
			<?php
			// @todo add support for page builders WP Block, Elementor, Bakery...

			// Output save settings button
			submit_button( __('Save Settings', 'bookingit') );
			?>
		</form>
        <h2><?php esc_html_e('Booking form preview:', 'bookingit'); ?></h2>
	</div>
	<?php
    do_shortcode('[bookingit_form]');
}