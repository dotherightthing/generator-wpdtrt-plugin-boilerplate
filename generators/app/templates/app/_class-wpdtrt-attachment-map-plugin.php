<?php
/**
 * Plugin class
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 * @since       0.6.0
 * @version 	1.0.0
 */

class <%= nameFriendlySafe %>_Plugin extends WPDTRT_Plugin {

    /**
     * Request the data from the API
     *
     * @uses        ../../../../wp-includes/http.php
     * @see         https://developer.wordpress.org/reference/functions/wp_remote_get/
     *
     * @since       0.1.0
     * @version     1.0.0
     *
     * @return      object The body of the JSON response
     */
    protected function get_api_data() {

		// Load existing options
		$options = get_option( $this->get_prefix() );

		$datatype = $options['datatype'];
		$last_updated = $options['last_updated'];

		if ( !isset ( $datatype ) ) {
			return (object)[];
		}

		$endpoint = 'http://jsonplaceholder.typicode.com/' . $datatype;

		$args = array(
			'timeout' => 30 // seconds to wait for the request to complete
		);

		$response = wp_remote_get(
			$endpoint,
			$args
		);

		/**
		 * Return the body, not the header
		 * Note: There is an optional boolean argument, which returns an associative array if TRUE
		 */
		$data = json_decode( $response['body'] );

		return $data;
    }

	/**
	* Refresh the data from the API
	*    The 'action' key's value, 'data_refresh',
	*    matches the latter half of the action 'wp_ajax_data_refresh' in our AJAX handler.
	*    This is because it is used to call the server side PHP function through admin-ajax.php.
	*    If an action is not specified, admin-ajax.php will exit, and return 0 in the process.
	*
	* @see         https://codex.wordpress.org/AJAX_in_Plugins
	* @todo        Create example
	*
	* @since       0.1.0
	* @version     1.0.0
	*
	* @todo 		Refactor this, referencing AJAX_in_Plugins
	*/
	protected function TODO_get_api_data_again() {

		$options = get_option( $this->get_prefix() );
		$last_updated = $options['last_updated'];

		if ( ! isset( $last_updated ) ) {
			wp_die();
		}

		$current_time = time();
		$update_difference = $current_time - $last_updated;
		$one_hour = (1 * 60 * 60);

		if ( $update_difference > $one_hour ) {

			$datatype = $options['datatype'];

			$options['data'] = $this->get_api_data( $datatype );

			// inspecting the database will allow us to check
			// whether the profile is being updated
			$options['last_updated'] = time();

			update_option( $this->get_prefix(), $options );
		}

		/**
		* Let the Ajax know when the entire function has completed
		*
		* wp_die() vs die() vs exit()
		* Most of the time you should be using wp_die() in your Ajax callback function.
		* This provides better integration with WordPress and makes it easier to test your code.
		*/
		wp_die();
	}

	/**
	 * Register Menus
	 *
	 * Adds locations to Appearance > Menus > Edit Menus tab > Menu settings > Display location,
	 * Adds locations to Appearance > Menus > Manage Locations tab
	 *
	 * @see http://www.wpbeginner.com/wp-themes/how-to-add-custom-navigation-menus-in-wordpress-3-0-themes/
	 * @see https://developer.wordpress.org/themes/functionality/navigation-menus/#register-menus
	 *
     * @since       0.6.0
   	 * @version     1.0.0
   	 * @todo add action to __construct without overriding the parent __construct
 	 * @todo For the actual nav see wpdtrt-responsive-nav/template-parts/wpdtrt-responsive-nav/navigation-header.php
	 */
	//add_action( 'init', [$this, 'render_menu_location'] );

	public function render_menu_location() {
	  register_nav_menus(
	    array(
	    	// Menu name set in wp_nav_menu => wp-admin Display location / Theme Location
	      	'<%= name %>-header-menu' => __( '<%= nameFriendly %> Menu', '<%= name %>' ),
	    )
	  );
	}

	/**
	 * Add rewrite rules in case another plugin flushes rules
	 */
	//add_action('init', [$this, 'set_rewrite_rules'] );

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
   	 * @todo add action to __construct without overriding the parent __construct
	 */
	public function set_rewrite_rules() {

	    global $wp_rewrite;

	    // ...
	}

}

?>