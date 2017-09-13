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

     $media = 'all';

    wp_enqueue_style( '<%= nameSafe %>_css_backend',
      <%= constantStub %>_URL . 'css/<%= name %>-admin.css',
      array(),
      <%= constantStub %>_VERSION,
      $media
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

    $media = 'all';

    /*
    wp_register_style( 'a_dependency',
      <%= constantStub %>_URL . 'vendor/bower_components/a_dependency/a_dependency.css',
      array(),
      DEPENDENCY_VERSION,
      $media
    );
    */

    wp_enqueue_style( '<%= nameSafe %>',
      <%= constantStub %>_URL . 'css/<%= name %>.css',
      array(
        'a_dependency'
      ),
      <%= constantStub %>_VERSION,
      $media
    );

  }

  add_action( 'wp_enqueue_scripts', '<%= nameSafe %>_css_frontend' );

}

?>
