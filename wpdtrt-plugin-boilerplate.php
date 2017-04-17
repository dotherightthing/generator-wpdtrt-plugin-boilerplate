<?php
/**
 * @package WP DTRT Plugin Boilerplate
 * @version 0.1
 */
/*
Plugin Name: WP DTRT Plugin Boilerplate
Plugin URI: http://www.dotherightthing.co.nz/
Description: A plugin boilerplate.
Author: Do The Right Thing
Version: 0.1
Author URI: http://www.dotherightthing.co.nz/
License: GPL2
*/

function wpdtrt_plugin_boilerplate_menu() {

  /**
   * Add a link to the admin menu
   * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function )
   * @link https://developer.wordpress.org/reference/functions/add_options_page/
   */

  add_options_page(
    'DTRT Plugin Boilerplate',
    'Boilerplate',
    'manage_options',
    'boilerplate',
    'wpdtrt_plugin_boilerplate_options_page'
  );
}

add_action('admin_menu', 'wpdtrt_plugin_boilerplate_menu');

function wpdtrt_plugin_boilerplate_options_page() {
  require( 'inc/options-page-wrapper.php' );
}



?>
