<?php
/**
 * Operations of the plugin are included here. 
 *
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Returns embed html.
 *
 * @param string $venue_slug
 *
 * @return string
 */
function bi_get_embed_html( $venue_slug = "" ) {
	return "<div id=\"bookingit_embed\"></div>
    <script src=\"https://bookingit.io/embed/embed.js\"></script>
    <script type=\"text/javascript\">
        bn({\"store\": \"$venue_slug\", \"logo\": false})
    </script>";
}

function bi_booking_form_shortcode() {
	$settings = bi_get_settings();

	if( ! isset($settings['bi_venue_slug']) || empty($settings['bi_venue_slug']) ) {
		echo '<div id="bookingit_embed"><p><strong>';
		esc_html_e( 'Please fill in the venue url in BookingIt settings in order to display the booking widget.', 'bookingit' );
		echo '</strong></p></div>';
		return;
	}
	echo $settings['bi_venue_slug']; // @todo display booking embed form, once it is ready
}

add_shortcode('bookingit_form', 'bi_booking_form_shortcode');