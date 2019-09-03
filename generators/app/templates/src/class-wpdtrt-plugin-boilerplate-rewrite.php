<?php
/**
 * File: src/class-<%= name %>-rewrite.php
 *
 * Rewrite sub class.
 *
 * Since:
 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
 */

/**
 * Class: <%= nameFriendlySafe %>_Rewrite
 *
 * Extends the base class to inherit boilerplate functionality, adds application-specific methods.
 */
class <%= nameFriendlySafe %>_Rewrite extends DoTheRightThing\WPDTRT_Plugin_Boilerplate\r_0_0_0\Rewrite {

	/**
	 * Function: __construct
	 *
	 * Supplement rewrite initialisation.
	 *
	 * Parameters:
	 *   $options - Rewrite options
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
	 * Function: wp_setup
	 *
	 * Supplement rewrite's WordPress setup.
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
