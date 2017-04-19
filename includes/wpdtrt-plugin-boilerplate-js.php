<?php
/**
 * JS imports
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
 * Specify and attach JS for the front-end widget
 */
add_action( 'wp_enqueue_scripts', 'wpdtrt_plugin_boilerplate_frontend_js' );

function wpdtrt_plugin_boilerplate_frontend_js() {

  wp_enqueue_script( 'wpdtrt_plugin_boilerplate_frontend_js',
    plugins_url( 'wpdtrt-plugin-boilerplate/public/js/wpdtrt-plugin-boilerplate.js' ),
    array( 'jquery' ),
    '', // string|bool|null, but TH tut says string only
    true
  );

}

?>
