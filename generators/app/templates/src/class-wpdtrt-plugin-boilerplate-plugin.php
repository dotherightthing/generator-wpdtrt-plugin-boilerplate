<?php
/**
 * File: src/class-<%= name %>-plugin.php
 *
 * Plugin sub class.
 *
 * Since:
 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
 */

/**
 * Class: <%= nameFriendlySafe %>_Plugin
 *
 * Extends the base class to inherit boilerplate functionality, adds application-specific methods.
 *
 * Since:
 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
 */
class <%= nameFriendlySafe %>_Plugin extends DoTheRightThing\WPDTRT_Plugin_Boilerplate\r_0_0_0\Plugin {

	/**
	 * Constructor: __construct
	 *
	 * Supplement plugin initialisation.
	 *
	 * Parameters:
	 *   $options - Plugin options
	 *
	 * Since:
	 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
	 */
	public function __construct( $options ) { // phpcs:ignore

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
	 * Note:
	 * - Default priority is 10. A higher priority runs later.
	 *
	 * See:
	 * - <Action order: https://codex.wordpress.org/Plugin_API/Action_Reference>
	 *
	 * Since:
	 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
	 */
	protected function wp_setup() { // phpcs:ignore

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
	 * Add project-specific frontend scripts
	 *
	 * Use this function to:
	 * - load scripts in addition to js/frontend-es5.js (via wp_enqueue_script)
	 * - add keys to <%= nameSafe %>_config (via wp_localize_script)
	 *
	 * Don't use function this to:
	 * - add ES6 scripts requiring transpiling (load them using frontend.txt instead)
	 *
	 * @see wpdtrt-plugin-boilerplate/src/Plugin.php
	 */
	public function render_js_frontend() { // phpcs:ignore
		// If editing this function, remove this line to replace the parent function.
		parent::render_js_frontend();
	}

	/**
	 * Group: Filters
	 * _____________________________________
	 */

	/**
	 * Group: Helpers
	 * _____________________________________
	 */
}
