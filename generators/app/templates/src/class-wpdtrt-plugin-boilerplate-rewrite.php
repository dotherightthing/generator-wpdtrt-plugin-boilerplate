<?php
/**
 * File: src/class-<%= name %>-rewrite.php
 *
 * Rewrite sub class.
 *
 * @package <%= nameFriendlySafe %>
 * @since   <%= generatorVersion %> DTRT WordPress Plugin Boilerplate Generator
 */

/**
 * Class: <%= nameFriendlySafe %>_Rewrite
 *
 * Extend the base class to inherit boilerplate functionality.
 *
 * Adds application-specific methods.
 */
class <%= nameFriendlySafe %>_Rewrite extends DoTheRightThing\WPDTRT_Plugin_Boilerplate\r_0_0_0\Rewrite {

	/**
	 * Function: __construct
	 *
	 * Supplement rewrite initialisation.
	 *
	 * Parameters:
	 *   (array) $options - Rewrite options.
	 */
	public function __construct( $options ) {

		// edit here.
		parent::__construct( $options );
	}

	/**
	 * ====== WordPress Integration ======
	 */

	/**
	 * Supplement rewrite's WordPress setup.
	 * Note: Default priority is 10. A higher priority runs later.
	 *
	 * @see https://codex.wordpress.org/Plugin_API/Action_Reference Action order
	 */
	protected function wp_setup() {

		// edit here.
		parent::wp_setup();
	}

	/**
	 * ====== Getters and Setters ======
	 */

	/**
	 * ===== Renderers =====
	 */

	/**
	 * ===== Filters =====
	 */

	/**
	 * ===== Helpers =====
	 */
}
