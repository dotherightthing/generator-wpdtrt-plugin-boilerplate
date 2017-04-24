<?php
/**
 * JS imports
 *
 * This file contains PHP.
 *
 * @link        <%= pluginUrl %>
 * @see         https://codex.wordpress.org/AJAX_in_Plugins
 * @since       0.1.0
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 */

if ( !function_exists( '<%= nameSafe %>_frontend_js' ) ) {

  /**
   * Attach JS for front-end widgets and shortcodes
   *    Generate a configuration object which the JavaScript can access.
   *    When an Ajax command is submitted, pass it to our function via the Admin Ajax page.
   *
   * @since       0.1.0
   * @see         https://codex.wordpress.org/AJAX_in_Plugins
   * @see         https://codex.wordpress.org/Function_Reference/wp_localize_script
   */
  function <%= nameSafe %>_frontend_js() {

    wp_enqueue_script( '<%= nameSafe %>_frontend_js',
      <%= constantStub %>_URL . 'views/public/js/<%= name %>.js',
      array('jquery'),
      <%= constantStub %>_VERSION,
      true
    );

    wp_localize_script( '<%= nameSafe %>_frontend_js',
      '<%= nameSafe %>_config',
      array(
        'ajax_url' => admin_url( 'admin-ajax.php' ) // <%= nameSafe %>_config.ajax_url
      )
    );

  }

  add_action( 'wp_enqueue_scripts', '<%= nameSafe %>_frontend_js' );

}

?>
