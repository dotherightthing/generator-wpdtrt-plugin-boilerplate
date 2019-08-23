<?php
/**
 * Shortcode sub class.
 *
 * @package <%= nameFriendlySafe %>
 * @version <%= defaultVersion %>
 * @since   <%= generatorVersion %> DTRT WordPress Plugin Boilerplate Generator
 */

/**
 * Class: <%= nameFriendlySafe %>_Shortcode
 *
 * Extend the base class to inherit boilerplate functionality.
 *
 * Adds application-specific methods.
 */
class <%= nameFriendlySafe %>_Shortcode extends DoTheRightThing\WPDTRT_Plugin_Boilerplate\r_0_0_0\Shortcode {

	/**
	 * Function: __construct
	 *
	 * Supplement shortcode initialisation.
	 *
	 * Parameters:
	 *   (array) $options - Shortcode options.
	 */
	public function __construct( $options ) {

		// edit here.
		parent::__construct( $options );
	}

	/**
	 * ====== WordPress Integration ======
	 */

	/**
	 * Supplement shortcode's WordPress setup.
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
