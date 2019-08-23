<?php
/**
 * File: src/class-<%= name %>-plugin.php
 *
 * Plugin sub class.
 *
 * @package <%= nameFriendlySafe %>
 * @since   <%= generatorVersion %> DTRT WordPress Plugin Boilerplate Generator
 */

/**
 * Class: <%= nameFriendlySafe %>_Plugin
 *
 * Extend the base class to inherit boilerplate functionality.
 *
 * Adds application-specific methods.
 */
class <%= nameFriendlySafe %>_Plugin extends DoTheRightThing\WPDTRT_Plugin_Boilerplate\r_0_0_0\Plugin {

	/**
	 * Function: __construct
	 *
	 * Supplement plugin initialisation.
	 *
	 * Parameters:
	 *   (array) $options - Plugin options.
	 */
	public function __construct( $options ) {

		// edit here.
		parent::__construct( $options );
	}

	/**
	 * Group: WordPress Integration
	 * _____________________________________
	 */

	/**
	 * Function: wp_setup
	 *
	 * Supplement plugin's WordPress setup.
	 *
	 * Note: Default priority is 10. A higher priority runs later.
	 *
	 * See: https://codex.wordpress.org/Plugin_API/Action_Reference Action order
	 */
	protected function wp_setup() {

		parent::wp_setup();

		// About: add actions and filters here.
	}

	/**
	 * Group: Getters and Setters
	 * _____________________________________
	 */

	/**
	 * Group: Renderers
	 * _____________________________________
	 */

	/**
	 * Group: Filters
	 * _____________________________________
	 */

	/**
	 * Group: Helpers
	 * _____________________________________
	 */
}
