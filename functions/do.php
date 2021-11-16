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
