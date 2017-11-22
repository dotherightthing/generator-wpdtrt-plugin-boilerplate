<?php
/**
 * Plugin sub class.
 *
 * @package     <%= nameSafe %>
 * @since       <%= version %>
 * @version 	<%= version %>
 */

/**
 * Plugin sub class.
 *
 * Extends the base class to inherit boilerplate functionality.
 * Adds application-specific methods.
 *
 * @since       <%= version %>
 * @version 	<%= version %>
 */
class <%= nameFriendlySafe %>_Plugin extends DoTheRightThing\WPPlugin\Plugin {

    /**
     * Hook the plugin in to WordPress
     * This constructor automatically initialises the object's properties
     * when it is instantiated,
     * using new WPDTRT_Weather_Plugin
     *
     * @param     array $settings Plugin options
     *
	 * @since       <%= version %>
	 * @version 	<%= version %>
     */
    function __construct( $settings ) {

    	// add any initialisation specific to <%= name %> here

		// Instantiate the parent object
		parent::__construct( $settings );
    }

    /* ====== Add public functions here ====== */

	/**
	 * Add custom rewrite rules
	 * WordPress allows theme and plugin developers to programmatically specify new, custom rewrite rules.
	 *
	 * @see http://clivern.com/how-to-add-custom-rewrite-rules-in-wordpress/
	 * @see https://www.pmg.com/blog/a-mostly-complete-guide-to-the-wordpress-rewrite-api/
	 * @see https://www.addedbytes.com/articles/for-beginners/url-rewriting-for-beginners/
	 * @see http://codex.wordpress.org/Rewrite_API
	 *
	 * @since       1.0.0
	 * @version     1.0.0
	 */
	public function set_rewrite_rules() {

	    global $wp_rewrite;

	    // Add rewrite rules in case another plugin flushes rules
	  	// add_action('init', [$this, 'set_rewrite_rules'] );
	    // ...
	}
}

?>