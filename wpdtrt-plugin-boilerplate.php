<?php
/**
 * Plugin logic
 *
 * This file contains the plugin functionality
 *
 * @link       http://www.dotherightthing.co.nz/
 * @version    1.0.0
 *
 * @package    DTRT_Plugin_Boilerplate
 */

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
 * Assign global variables
 */

  $plugin_url = WP_PLUGIN_URL . '/wpdtrt-plugin-boilerplate';

/**
 * Store all of our plugin options in an array
 * So that we only use have to consume one row in the WP Options table
 * WordPress automatically serializes this (into a string)
 * because mySql does not support arrays as a data type
 */
  $options = array();

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
