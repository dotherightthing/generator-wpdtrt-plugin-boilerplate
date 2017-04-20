<?php
/**
 * CSS imports
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
 * Specify and attach CSS for Settings > Boilerplate
 */

if ( !function_exists( 'wpdtrt_plugin_boilerplate_css_backend' ) ) {

  add_action( 'admin_head', 'wpdtrt_plugin_boilerplate_css_backend' );

  function wpdtrt_plugin_boilerplate_css_backend() {

    wp_enqueue_style( 'wpdtrt_plugin_boilerplate_css_backend',
      WPDTRT_PLUGIN_BOILERPLATE_URL . 'views/admin/css/wpdtrt-plugin-boilerplate.css',
      array(),
      WPDTRT_PLUGIN_BOILERPLATE_VERSION
      //'all'
    );
  }

}

/**
 * Specify and attach CSS for the front-end widget
 */
if ( !function_exists( 'wpdtrt_plugin_boilerplate_css_frontend' ) ) {

  add_action( 'wp_enqueue_scripts', 'wpdtrt_plugin_boilerplate_css_frontend' );

  function wpdtrt_plugin_boilerplate_css_frontend() {

    wp_enqueue_style( 'wpdtrt_plugin_boilerplate_css_frontend',
      WPDTRT_PLUGIN_BOILERPLATE_URL . 'views/public/css/wpdtrt-plugin-boilerplate.css',
      array(),
      WPDTRT_PLUGIN_BOILERPLATE_VERSION
      //'all'
    );

  }
}

?>
