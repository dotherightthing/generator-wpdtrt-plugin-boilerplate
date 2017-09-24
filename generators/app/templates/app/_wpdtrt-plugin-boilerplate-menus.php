<?php
/**
 * Navigation menus
 *
 * This file contains PHP.
 *
 * @since       0.1.0
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 *
 * @todo For the actual nav see wpdtrt-responsive-nav/template-parts/wpdtrt-responsive-nav/navigation-header.php
 */

/**
 * Pluggable
 * Allow child themes to replace this function with their own
 */
if ( ! function_exists('<%= nameSafe %>_register_menus') ) {

	/**
	 * Register Menus
	 *
	 * Adds locations to Appearance > Menus > Edit Menus tab > Menu settings > Display location,
	 * Adds locations to Appearance > Menus > Manage Locations tab
	 *
	 * @see http://www.wpbeginner.com/wp-themes/how-to-add-custom-navigation-menus-in-wordpress-3-0-themes/
	 * @see https://developer.wordpress.org/themes/functionality/navigation-menus/#register-menus
	 */
	//add_action( 'init', '<%= nameSafe %>_register_menus' );

	function <%= nameSafe %>_register_menus() {
	  register_nav_menus(
	    array(
	    	// Menu name set in wp_nav_menu => wp-admin Display location / Theme Location
	      	'<%= name %>-header-menu' => __( '<%= nameFriendly %> Menu', '<%= name %>' ),
	    )
	  );
	}
}

?>
