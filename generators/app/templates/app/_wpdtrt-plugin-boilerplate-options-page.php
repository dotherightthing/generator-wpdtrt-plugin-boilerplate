<?php
/**
 * Functionality for the WP Admin Plugin Options page
 * WP Admin > Settings > <%= nameFriendly %>
 *
 * This file contains PHP.
 *
 * @link       <%= pluginUrl %>
 * @since      0.1.0
 *
 * @package    <%= nameFriendlySafe %>
 * @subpackage <%= nameFriendlySafe %>/includes
 */

/**
 * <%= nameSafe %>_menu()
 * Display a link to the options page in the admin menu
 * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function )
 * @link https://developer.wordpress.org/reference/functions/add_options_page/
 */
if ( !function_exists( '<%= nameSafe %>_menu' ) ) {

  add_action('admin_menu', '<%= nameSafe %>_menu');

  function <%= nameSafe %>_menu() {

    add_options_page(
      '<%= nameFriendly %>',
      '<%= nameAdminMenu %>',
      'manage_options',
      '<%= pluginUrlAdminMenu %>',
      '<%= nameSafe %>_options_page'
    );
  }

}

/**
 * Create the plugin options page
 */
if ( !function_exists( '<%= nameSafe %>_options_page' ) ) {

  /**
   * <%= nameSafe %>_options_page()
   * 1. Take the user's selection (from the form input)
   * 2. Request the data from the API
   * 3. Store 3 pieces of data in the options table:
   *    a. The user's selection: '<%= nameSafe %>_datatype',
   *       so that the dataset can be regenerated after a specified amount of time
   *    b. The data set generated by the API: '<%= nameSafe %>_data'
   *    c. The time that the data set was generated: 'last_updated'
   * 4. Render the options page
   *
   * Note: Shortcode/widget options are specific to each instance of the shortcode/widget
   * and are thus stored with those individual instances.
   */

  function <%= nameSafe %>_options_page() {

    if ( ! current_user_can( 'manage_options' ) ) {
      wp_die( 'Sorry, you do not have sufficient permissions to access this page.' );
    }

    /**
     * Make this global available within the required statement
     */
    global $<%= nameSafe %>_options;

    if ( isset( $_POST['<%= nameSafe %>_form_submitted'] ) ) {

      // check that the form submission was legitimate
      $hidden_field = esc_html( $_POST['<%= nameSafe %>_form_submitted'] );

      if ( $hidden_field === 'Y' ) {

        // 1. get user preferences from form submission
        $<%= nameSafe %>_datatype = esc_html( $_POST['<%= nameSafe %>_datatype'] );

        // 2. send user preferences to API to get results
        $<%= nameSafe %>_data = <%= nameSafe %>_data_get(
          $<%= nameSafe %>_datatype
        );

        // 3a. store user preferences in options object
        $<%= nameSafe %>_options['<%= nameSafe %>_datatype'] = $<%= nameSafe %>_datatype;

        // 3b. store API results in options object
        $<%= nameSafe %>_options['<%= nameSafe %>_data'] = $<%= nameSafe %>_data;

        // 3c. store timestamp in options object
        $<%= nameSafe %>_options['last_updated'] = time(); // UNIX timestamp for the current time

        /**
         * Save options object to database
         *
         * Update the plugin data stored in the WP Options table
         * This function may be used in place of add_option, although it is not as flexible.
         * update_option will check to see if the option already exists.
         * If it does not, it will be added with add_option('option_name', 'option_value').
         * Unless you need to specify the optional arguments of add_option(),
         * update_option() is a useful catch-all for both adding and updating options.
         * @example update_option( string $option, mixed $value, string|bool $autoload = null )
         * @link https://codex.wordpress.org/Function_Reference/update_option
         */
        update_option( '<%= nameSafe %>', $<%= nameSafe %>_options, null );
      }
    }

    /**
     * Load the plugin data stored in the WP Options table
     * Retrieves an option value based on an option name.
     * @example get_option( string $option, mixed $default = false )
     */
    $<%= nameSafe %>_options = get_option( '<%= nameSafe %>' );

    // if options have been stored, recover them
    if ( $<%= nameSafe %>_options !== '' ) {
      $<%= nameSafe %>_datatype = $<%= nameSafe %>_options['<%= nameSafe %>_datatype'];
      $<%= nameSafe %>_data = $<%= nameSafe %>_options['<%= nameSafe %>_data'];
    }

    /**
     * 4. Load the HTML template
     * This function's variables will be available to this template.
     * @todo display the last generated timestamp on the options page
     */
    require_once(<%= constantStub %>_PATH . 'views/admin/partials/<%= name %>-options-page.php');
  }

}

?>
