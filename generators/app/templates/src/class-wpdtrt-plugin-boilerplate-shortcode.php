<?php
/**
 * File: src/class-<%= name %>-shortcode.php
 *
 * Shortcode sub class.
 *
 * Since:
 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
 */

/**
 * Class: <%= nameFriendlySafe %>_Shortcode
 *
 * Extends the base class to inherit boilerplate functionality, adds application-specific methods.
 *
 * Since:
 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
 */
class <%= nameFriendlySafe %>_Shortcode extends DoTheRightThing\WPDTRT_Plugin_Boilerplate\r_0_0_0\Shortcode {

	/**
	 * Constructor: __construct
	 *
	 * Supplement shortcode initialisation.
	 *
	 * Parameters:
	 *   $options - Shortcode options
	 *
	 * Since:
	 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
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
	 * Method: wp_setup
	 *
	 * Supplement shortcode's WordPress setup.
	 *
	 * Note:
	 * - Default priority is 10. A higher priority runs later.
	 *
	 * See:
	 * - <Action order: https://codex.wordpress.org/Plugin_API/Action_Reference>
	 *
	 * Since:
	 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
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
