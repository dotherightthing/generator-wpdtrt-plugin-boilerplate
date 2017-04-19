<?php
/**
 * Functionality for the WP Admin Plugin Options page
 * WP Admin > Settings > DTRT Plugin Boilerplate
 *
 * This file contains PHP.
 *
 * @link       http://www.dotherightthing.co.nz/
 * @since      1.0.0
 *
 * @package    DTRT_Plugin_Boilerplate
 * @subpackage DTRT_Plugin_Boilerplate/includes
 */

/**
 * Display a link to the options page in the admin menu
 * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function )
 * @link https://developer.wordpress.org/reference/functions/add_options_page/
 */
if ( !function_exists( 'wpdtrt_plugin_boilerplate_menu' ) ) {

  add_action('admin_menu', 'wpdtrt_plugin_boilerplate_menu');

  function wpdtrt_plugin_boilerplate_menu() {

    add_options_page(
      'DTRT Plugin Boilerplate',
      'Boilerplate',
      'manage_options',
      'boilerplate',
      'wpdtrt_plugin_boilerplate_options_page'
    );
  }

}

/**
 * Create the plugin options page
 */
if ( !function_exists( 'wpdtrt_plugin_boilerplate_options_page' ) ) {

  function wpdtrt_plugin_boilerplate_options_page() {

    if ( ! current_user_can( 'manage_options' ) ) {
      wp_die( 'You do not have sufficient permissions to access this page.' );
    }

    /**
     * Make this global available within the required statement
     */
    global $plugin_url;
    global $options;

    if ( isset( $_POST['wpdtrt_form_submitted'] ) ) {
      $hidden_field = esc_html( $_POST['wpdtrt_form_submitted'] );

      if ( $hidden_field === 'Y' ) {
        $wpdtrt_username = esc_html( $_POST['wpdtrt_username'] );
        $wpdtrt_data = wpdtrt_plugin_boilerplate_data_get( $wpdtrt_username );

        $options['wpdtrt_username'] = $wpdtrt_username;
        $options['last_updated'] = time(); // UNIX timestamp for the current time
        $options['wpdtrt_data'] = $wpdtrt_data;

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
        update_option( 'wpdtrt_plugin_boilerplate', $options, null );
      }
    }

    /**
     * Load the plugin data stored in the WP Options table
     * Retrieves an option value based on an option name.
     * @example get_option( string $option, mixed $default = false )
     */
    $options = get_option( 'wpdtrt_plugin_boilerplate' );

    if ( $options !== '' ) {
      $wpdtrt_username = $options['wpdtrt_username'];
      $wpdtrt_data = $options['wpdtrt_data'];
    }

    /**
     * Use var_dump rather than print_r,
     * as the former reveals the data types used,
     * so we can check whether the data is in the expected format
     * @link http://kb.network.dan/php/print_r-vs-var_dump/
     */
    //var_dump($wpdtrt_data);

    /**
     * Load the HTML template
     * This function's variables will be available to this template.
     */
    require_once( 'admin/partials/wpdtrt-plugin-boilerplate-options-page.php' );
  }

}

?>
