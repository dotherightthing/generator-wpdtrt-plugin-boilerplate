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

  function <%= nameSafe %>_options_page() {

    if ( ! current_user_can( 'manage_options' ) ) {
      wp_die( 'You do not have sufficient permissions to access this page.' );
    }

    /**
     * Make this global available within the required statement
     */
    global $<%= nameSafe %>_options;

    if ( isset( $_POST['<%= nameSafe %>_form_submitted'] ) ) {
      $hidden_field = esc_html( $_POST['<%= nameSafe %>_form_submitted'] );

      if ( $hidden_field === 'Y' ) {
        $<%= nameSafe %>_username = esc_html( $_POST['<%= nameSafe %>_username'] );
        $<%= nameSafe %>_data = <%= nameSafe %>_data_get( $<%= nameSafe %>_username );

        $<%= nameSafe %>_options['<%= nameSafe %>_username'] = $<%= nameSafe %>_username;
        $<%= nameSafe %>_options['last_updated'] = time(); // UNIX timestamp for the current time
        $<%= nameSafe %>_options['<%= nameSafe %>_data'] = $<%= nameSafe %>_data;

        /**
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

    if ( $<%= nameSafe %>_options !== '' ) {
      $<%= nameSafe %>_username = $<%= nameSafe %>_options['<%= nameSafe %>_username'];
      $<%= nameSafe %>_data = $<%= nameSafe %>_options['<%= nameSafe %>_data'];
    }

    /**
     * Use var_dump rather than print_r,
     * as the former reveals the data types used,
     * so we can check whether the data is in the expected format
     * @link http://kb.network.dan/php/print_r-vs-var_dump/
     */
    //var_dump($<%= nameSafe %>_data);

    /**
     * Load the HTML template
     * This function's variables will be available to this template.
     */
    require_once(<%= constantStub %>_PATH . 'views/admin/partials/<%= name %>-options-page.php');
  }

}

?>
