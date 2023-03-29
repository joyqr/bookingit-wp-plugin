<?php
/**
 * Operations of the plugin are included here. 
 *
 * @since 1.0.0
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
function bookingit_get_embed_html( $venue_slug = "" ) {
	wp_enqueue_script( 'bookingit-iframeResizer', 'https://bookingit.io/js/iframeResizer.min.js', array(), '1.0' );
	wp_enqueue_script( 'bookingit-embed', 'https://bookingit.io/js/embed.js', array(), '1.0' );

	echo "<div id=\"booking_it_embed\"  style=\"height: 800px;\"></div>";

	wp_add_inline_script( 'bookingit-embed', "embedData({\"store\": \"$venue_slug\", \"logo\": false })" );

	return;
}

function bookingit_booking_form_shortcode() {
	$settings = bookingit_get_settings();

	// @todo handle booking form doesn't exist

	if( !isset($settings['bookingit_venue_slug']) || empty($settings['bookingit_venue_slug']) ) {
		echo '<div id="bookingit_embed"><p><strong>';
		esc_html_e( 'Please fill in the venue url in BookingIt settings in order to display the booking widget.', 'bookingit' );
		echo '</strong></p></div>';
		return;
	}

	return bookingit_get_embed_html( esc_html( $settings['bookingit_venue_slug'] ) );
}

add_shortcode( 'bookingit_form', 'bookingit_booking_form_shortcode' );