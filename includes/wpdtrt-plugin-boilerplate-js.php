<?php
/**
 * JS imports
 *
 * This file contains PHP.
 *
 * @link       http://www.dotherightthing.co.nz/
 * @link       https://codex.wordpress.org/AJAX_in_Plugins
 * @since      1.0.0
 *
 * @package    DTRT_Plugin_Boilerplate
 * @subpackage DTRT_Plugin_Boilerplate/includes
 */

/**
 * Specify and attach JS for the front-end widget
 */
if ( !function_exists( 'wpdtrt_plugin_boilerplate_frontend_js' ) ) {

add_action( 'wp_enqueue_scripts', 'wpdtrt_plugin_boilerplate_frontend_js' );

  function wpdtrt_plugin_boilerplate_frontend_js() {

    wp_enqueue_script( 'wpdtrt_plugin_boilerplate_frontend_js',
      WPDTRT_PLUGIN_BOILERPLATE_URL . 'views/public/js/wpdtrt-plugin-boilerplate.js',
      array( 'jquery' ),
      '', // string|bool|null, but TH tut says string only
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
    wp_localize_script( 'wpdtrt_plugin_boilerplate_frontend_js',
      'wpdtrt_plugin_boilerplate_config',
      array(
        'ajax_url' => admin_url( 'admin-ajax.php' ) // wpdtrt_plugin_boilerplate_config.ajax_url
      )
    );

  }

}

?>
