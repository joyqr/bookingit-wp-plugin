# WordPress Starter Plugin

A well documented starter plugin for quick WordPress plugin development complete with inline documentation and working admin options page.


# Directory Structure

- /admin/ 						- Plugin backend stuff.
- /functions/					- Functions and plugin operations.
- /includes/					- External third party classes and libraries.
- /languages/					- Translation files go here. 
- /public/						- Front end files and functions that matter on the front end go here.
- index.php						- Dummy file.
- license.txt					- GPL v2
- bi_bookingit.php		- Main plugin file containing plugin name and other version info for WordPress.
- readme.txt					- Readme for WordPress plugin repository. https://wordpress.org/plugins/files/2018/01/readme.txt
- uninstall.php					- Fired when the plugin is uninstalled. 


# TODO

- Note: (S&R) = Search and Replace by matching case.
- Plugin name: Starter Plugin (S&R)
- Plugin folder slug: bookingit (S&R)
- Decide on a prefix for the plugin (S&R)
- Plugin description					in bi_bookingit.php
- Text domain. Text domain for plugins has to be the folder name of the plugin. For eg. if your plugin is in /wp-content/plugins/abc-def/ folder text domain should be abc-def (S&R)
- Update bi_settings_link() 		in \admin\basic-setup.php
- Update bi_footer_text()			in \admin\basic-setup.php
- Update bi_add_menu_links() 		in \admin\admin-ui-setup.php
- Update bi_register_settings() 	in \admin\admin-ui-setup.php
- Update UI format and settings			in \admin\admin-ui-render.php
- Update uninstall.php
- Update readme.txt
- Update BI_VERSION_NUM 			in bi_bookingit.php (keep this line for future updates)