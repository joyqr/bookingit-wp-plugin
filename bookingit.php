<?php
/**
 * Plugin Name: BookingIt - Booking System
 * Plugin URI: https://bookingit.io
 * Description: Integrate your BookingIt account with WordPress. Easily add booking form to any page, using shortcode
 * or custom blocks. Easily create and manage your own booking system. Modernise Bookings For Your Restaurant, Winery,
 * Or Cafe. Set up in 5 minutes!
 * Author: bookingit.io
 * Author URI: https://bookingit.io
 * Version: 1.0
 * Text Domain: bookingit
 * Domain Path: /languages
 * License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * This plugin was developed using the WordPress starter plugin template by Arun Basil Lal <arunbasillal@gmail.com>
 * Please leave this credit and the directory structure intact for future developers who might read the code.
 * @GitHub https://github.com/arunbasillal/WordPress-bookingit
 */
 
/**
 * ~ Directory Structure ~
 *
 * /admin/ 					- Plugin backend stuff.
 * /functions/					- Functions and plugin operations.
 * /includes/					- External third party classes and libraries.
 * /languages/					- Translation files go here. 
 * /public/					- Front end files and functions that matter on the front end go here.
 * index.php					- Dummy file.
 * license.txt					- GPL v2
 * bookingit.php				- Main plugin file containing plugin name and other version info for WordPress.
 * readme.txt					- Readme for WordPress plugin repository. https://wordpress.org/plugins/files/2018/01/readme.txt
 * uninstall.php				- Fired when the plugin is uninstalled. 
 */
 
/**
 * ~ TODO ~
 *
 * - Note: (S&R) = Search and Replace by matching case.
 *
 * - Plugin name: Starter Plugin (S&R)
 * - Plugin folder slug: bookingit (S&R)
 * - Decide on a prefix for the plugin (S&R)
 * - Plugin description
 * - Text domain. Text domain for plugins has to be the folder name of the plugin. For eg. if your plugin is in /wp-content/plugins/abc-def/ folder text domain should be abc-def (S&R)
 * - Update bookingit_settings_link() 		in \admin\basic-setup.php
 * - Update bookingit_footer_text()		in \admin\basic-setup.php
 * - Update bookingit_add_menu_links() 		in \admin\admin-ui-setup.php
 * - Update bookingit_register_settings() 		in \admin\admin-ui-setup.php
 * - Update UI format and settings		in \admin\admin-ui-render.php
 * - Update uninstall.php
 * - Update readme.txt
 * - Update BOOKINGIT_VERSION_NUM 			in bookingit.php (keep this line for future updates)
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Define constants
 *
 * @since 1.0
 */
if ( ! defined( 'BOOKINGIT_VERSION_NUM' ) ) 		define( 'BOOKINGIT_VERSION_NUM'		, '1.0' ); // Plugin version constant
if ( ! defined( 'BOOKINGIT_STARTER_PLUGIN' ) )		define( 'BOOKINGIT_STARTER_PLUGIN'		, trim( dirname( plugin_basename( __FILE__ ) ), '/' ) ); // Name of the plugin folder eg - 'bookingit'
if ( ! defined( 'BOOKINGIT_STARTER_PLUGIN_DIR' ) )	define( 'BOOKINGIT_STARTER_PLUGIN_DIR'	, plugin_dir_path( __FILE__ ) ); // Plugin directory absolute path with the trailing slash. Useful for using with includes eg - /var/www/html/wp-content/plugins/bookingit/
if ( ! defined( 'BOOKINGIT_STARTER_PLUGIN_URL' ) )	define( 'BOOKINGIT_STARTER_PLUGIN_URL'	, plugin_dir_url( __FILE__ ) ); // URL to the plugin folder with the trailing slash. Useful for referencing src eg - http://localhost/wp/wp-content/plugins/bookingit/
if ( ! defined( 'BOOKINGIT_SHORTCODE' ) )	        define( 'BOOKINGIT_SHORTCODE'          , '[bookingit_form]' ); // URL to the plugin folder with the trailing slash. Useful for referencing src eg - http://localhost/wp/wp-content/plugins/bookingit/

/**
 * Database upgrade todo
 *
 * @since 1.0
 */
function bookingit_upgrader() {
	
	// Get the current version of the plugin stored in the database.
	$current_ver = get_option( 'abl_bookingit_version', '0.0' );
	
	// Return if we are already on updated version. 
	if ( version_compare( $current_ver, BOOKINGIT_VERSION_NUM, '==' ) ) {
		return;
	}
	
	// This part will only be excuted once when a user upgrades from an older version to a newer version.
	
	// Finally add the current version to the database. Upgrade todo complete. 
	update_option( 'abl_bookingit_version', BOOKINGIT_VERSION_NUM );
}
add_action( 'admin_init', 'bookingit_upgrader' );

// Load everything
require_once( BOOKINGIT_STARTER_PLUGIN_DIR . 'loader.php' );

// Register activation hook (this has to be in the main plugin file or refer bit.ly/2qMbn2O)
register_activation_hook( __FILE__, 'bookingit_activate_plugin' );