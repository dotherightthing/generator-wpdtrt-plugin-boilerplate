<?php
/**
 * CSS imports
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
 * Specify and attach CSS for Settings > Boilerplate
 */

if ( !function_exists( '<%= nameSafe %>_css_backend' ) ) {

  add_action( 'admin_head', '<%= nameSafe %>_css_backend' );

  function <%= nameSafe %>_css_backend() {

    wp_enqueue_style( '<%= nameSafe %>_css_backend',
      <%= constantStub %>_URL . 'views/admin/css/<%= name %>.css',
      array(),
      <%= constantStub %>_VERSION
      //'all'
    );
  }

}

/**
 * Specify and attach CSS for the front-end widget
 */
if ( !function_exists( '<%= nameSafe %>_css_frontend' ) ) {

  add_action( 'wp_enqueue_scripts', '<%= nameSafe %>_css_frontend' );

  function <%= nameSafe %>_css_frontend() {

    wp_enqueue_style( '<%= nameSafe %>_css_frontend',
      <%= constantStub %>_URL . 'views/public/css/<%= name %>.css',
      array(),
      <%= constantStub %>_VERSION
      //'all'
    );

  }
}

?>
