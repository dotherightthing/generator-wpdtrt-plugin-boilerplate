<?php
/**
 * JS imports
 *
 * This file contains PHP.
 *
 * @link       <%= pluginUrl %>
 * @link       https://codex.wordpress.org/AJAX_in_Plugins
 * @since      <%= version %>
 *
 * @package    <%= nameFriendlySafe %>
 * @subpackage <%= nameFriendlySafe %>/includes
 */

/**
 * Specify and attach JS for the front-end widget
 */
if ( !function_exists( '<%= nameSafe %>_frontend_js' ) ) {

  add_action( 'wp_enqueue_scripts', '<%= nameSafe %>_frontend_js' );

  function <%= nameSafe %>_frontend_js() {

    wp_enqueue_script( '<%= nameSafe %>_frontend_js',
      <%= constantStub %>_URL . 'views/public/js/<%= name %>.js',
      array('jquery'),
      <%= constantStub %>_VERSION,
      true
    );

    /**
     * Permit the Ajax call when an Ajax command is submitted,
     * passing it through the Admin Ajax page, and then onto our refresh_data function.
     *
     * wp_localize_script
     * @param string $handle
     * @param string $name
     * @param array $data
     * @link https://codex.wordpress.org/AJAX_in_Plugins
     * @link https://codex.wordpress.org/Function_Reference/wp_localize_script
     */
    wp_localize_script( '<%= nameSafe %>_frontend_js',
      '<%= nameSafe %>_config',
      array(
        'ajax_url' => admin_url( 'admin-ajax.php' ) // <%= nameSafe %>_config.ajax_url
      )
    );

  }

}

?>
