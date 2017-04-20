<?php
/*
Plugin Name: DTRT Plugin Boilerplate
Plugin URI: http://www.dotherightthing.co.nz/
Description: A best-practice boilerplate for plugin development.
Author: Do The Right Thing
Version: 1.0.0
Author URI: http://www.dotherightthing.co.nz/
License: GPL2
*/

/**
 * Constants
 * WordPress makes use of the following constants when determining the path to the content and plugin directories.
 * These should not be used directly by plugins or themes, but are listed here for completeness.
 * WP_CONTENT_DIR  // no trailing slash, full paths only
 * WP_CONTENT_URL  // full url
 * WP_PLUGIN_DIR  // full path, no trailing slash
 * WP_PLUGIN_URL  // full url, no trailing slash
 *
 * WordPress provides several functions for easily determining where a given file or directory lives.
 * Always use these functions in your plugins instead of hard-coding references to the wp-content directory
 * or using the WordPress internal constants.
 * plugins_url()
 * plugin_dir_url()
 * plugin_dir_path()
 * plugin_basename()
 *
 * @link https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Constants
 * @link https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Plugins
 */

/**
 * plugin_dir_path
 * @param string $file
 * @return The filesystem directory path (with trailing slash)
 * @link https://developer.wordpress.org/reference/functions/plugin_dir_path/
 * @link https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
 */
if( ! defined( 'WPDTRT_PLUGIN_BOILERPLATE_PATH' ) ) {
  define( 'WPDTRT_PLUGIN_BOILERPLATE_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * plugin_dir_url
 * @param string $file
 * @return The URL (with trailing slash)
 * @link https://codex.wordpress.org/Function_Reference/plugin_dir_url
 * @link https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
 */
if( ! defined( 'WPDTRT_PLUGIN_BOILERPLATE_URL' ) ) {
  define( 'WPDTRT_PLUGIN_BOILERPLATE_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Store all of our plugin options in an array
 * So that we only use have to consume one row in the WP Options table
 * WordPress automatically serializes this (into a string)
 * because MySQL does not support arrays as a data type
 */
  $wpdtrt_plugin_boilerplate_options = array();

/**
 * Include plugin logic
 */

  // API data
  require_once('includes/wpdtrt-plugin-boilerplate-data.php');

  // Views
  require_once('includes/wpdtrt-plugin-boilerplate-options-page.php');
  require_once('includes/wpdtrt-plugin-boilerplate-widget.php');

  // Theming
  require_once('includes/wpdtrt-plugin-boilerplate-css.php');
  require_once('includes/wpdtrt-plugin-boilerplate-js.php');

  // Shortcode
  require_once('includes/wpdtrt-plugin-boilerplate-shortcode.php');

?>
