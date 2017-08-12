<?php
/**
 * CSS imports
 *
 * This file contains PHP.
 *
 * @link        <%= pluginUrl %>
 * @since       0.1.0
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 */

if ( !function_exists( '<%= nameSafe %>_css_backend' ) ) {

  /**
   * Attach CSS for Settings > <%= nameAdminMenu %>
   *
   * @since       0.1.0
   */
  function <%= nameSafe %>_css_backend() {

    wp_enqueue_style( '<%= nameSafe %>_css_backend',
      <%= constantStub %>_URL . 'css/<%= name %>-admin.css',
      array(),
      <%= constantStub %>_VERSION
      //'all'
    );
  }

  add_action( 'admin_head', '<%= nameSafe %>_css_backend' );

}

if ( !function_exists( '<%= nameSafe %>_css_frontend' ) ) {

  /**
   * Attach CSS for front-end widgets and shortcodes
   *
   * @since       0.1.0
   */
  function <%= nameSafe %>_css_frontend() {

    wp_enqueue_style( '<%= nameSafe %>_css_frontend',
      <%= constantStub %>_URL . 'css/<%= name %>.css',
      array(),
      <%= constantStub %>_VERSION
      //'all'
    );

  }

  add_action( 'wp_enqueue_scripts', '<%= nameSafe %>_css_frontend' );

}

?>
