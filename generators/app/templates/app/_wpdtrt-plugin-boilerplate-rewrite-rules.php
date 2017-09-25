<?php
/**
 * Rewrite Rules
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 * @since       0.1.0
 */

if ( !function_exists( '<%= nameSafe %>_rewrite_rules' ) ) {

	/**
	 * Add rewrite rules in case another plugin flushes rules
	 */
	add_action('init', '<%= nameSafe %>_rewrite_rules');

	/**
	 * Add custom rewrite rules
	 * WordPress allows theme and plugin developers to programmatically specify new, custom rewrite rules.
	 *
	 * @see http://clivern.com/how-to-add-custom-rewrite-rules-in-wordpress/
	 * @see https://www.pmg.com/blog/a-mostly-complete-guide-to-the-wordpress-rewrite-api/
	 * @see https://www.addedbytes.com/articles/for-beginners/url-rewriting-for-beginners/
	 * @see http://codex.wordpress.org/Rewrite_API
	 *
	 * @since       0.6.0
	 * @version     1.0.0
	 */
	function <%= nameSafe %>_rewrite_rules() {

	    global $wp_rewrite;

	    // ...
	}
}

?>