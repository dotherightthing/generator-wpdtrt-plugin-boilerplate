<?php
/**
 * Plugin sub class.
 *
 * @package     <%= nameSafe %>
 * @version 	0.0.1
 * @since       <%= generatorVersion %>
 */

/**
 * Plugin sub class.
 *
 * Extends the base class to inherit boilerplate functionality.
 * Adds application-specific methods.
 *
 * @version 	0.0.1
 * @since       <%= generatorVersion %>
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
	 * @version 	0.0.1
     * @since       <%= generatorVersion %>
     */
    function __construct( $settings ) {

    	// add any initialisation specific to <%= name %> here

		// Instantiate the parent object
		parent::__construct( $settings );
    }

    //// START WORDPRESS INTEGRATION \\\\

    /**
     * Initialise plugin options ONCE.
     *
     * @param array $default_options
     *
     * @version     0.0.1
     * @since       <%= generatorVersion %>
     */
    protected function wp_setup() {

    	parent::wp_setup();

		// add actions and filters here
    }

    //// END WORDPRESS INTEGRATION \\\\

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
	 * @version     0.0.1
     * @since       <%= generatorVersion %>
	 */
	public function set_rewrite_rules() {

	    global $wp_rewrite;

	    // Add rewrite rules in case another plugin flushes rules
	  	// add_action('init', [$this, 'set_rewrite_rules'] );
	    // ...
	}
}

?>