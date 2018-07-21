<?php
/**
 * Plugin sub class.
 *
 * @package <%= nameSafe %>
 * @version <%= defaultVersion %>
 * @since   <%= generatorVersion %> DTRT WordPress Plugin Boilerplate Generator
 */

/**
 * Extend the base class to inherit boilerplate functionality.
 * Adds application-specific methods.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
class <%= nameFriendlySafe %>_Plugin extends DoTheRightThing\WPDTRT_Plugin_Boilerplate\r_0_0_0\Plugin {

	/**
	 * Supplement plugin initialisation.
	 *
	 * @param     array $options Plugin options.
	 * @since     1.0.0
	 * @version   1.1.0
	 */
	public function __construct( $options ) {

		// edit here.
		parent::__construct( $options );
	}

	/**
	 * ====== WordPress Integration ======
	 */

	/**
	 * Supplement plugin's WordPress setup.
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
