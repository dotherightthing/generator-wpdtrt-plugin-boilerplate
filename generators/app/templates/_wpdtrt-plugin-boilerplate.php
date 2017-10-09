<?php
/*
Plugin Name:  <%= nameFriendly %>
Plugin URI:   <%= pluginUrl %>
Description:  <%= description %>
Version:      <%= version %>
Author:       <%= authorName %>
Author URI:   <%= authorUrl %>
License:      <%= pluginLicense %>
License URI:  <%= pluginLicenseUrl %>
Text Domain:  <%= name %>
Domain Path:  /languages
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
 * Plugin version
 * WP provides get_plugin_data(), but it only works within WP Admin,
 * so we define a constant instead.
 *
 * @example $plugin_data = get_plugin_data( __FILE__ ); $plugin_version = $plugin_data['Version'];
 * @link https://wordpress.stackexchange.com/questions/18268/i-want-to-get-a-plugin-version-number-dynamically
 *
 * @since     0.1.0
 * @version   1.0.0
 */
if( ! defined( '<%= constantStub %>_VERSION' ) ) {
  define( '<%= constantStub %>_VERSION', '0.1' );
}

/**
 * plugin_dir_path
 *
 * @param string $file
 * @return The filesystem directory path (with trailing slash)
 *
 * @link https://developer.wordpress.org/reference/functions/plugin_dir_path/
 * @link https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
 *
 * @since     0.1.0
 * @version   1.0.0
 */
if( ! defined( '<%= constantStub %>_PATH' ) ) {
  define( '<%= constantStub %>_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * The version information is only available within WP Admin
 *
 * @param string $file
 * @return The URL (with trailing slash)
 *
 * @link https://codex.wordpress.org/Function_Reference/plugin_dir_url
 * @link https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
 *
 * @since     0.1.0
 * @version   1.0.0
 */
if( ! defined( '<%= constantStub %>_URL' ) ) {
  define( '<%= constantStub %>_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Include plugin logic
 *
 * @since     0.1.0
 * @version   1.0.0
 */

  // base classes
  require_once(<%= constantStub %>_PATH . 'vendor/gamajo/template-loader/class-gamajo-template-loader.php');
  require_once(<%= constantStub %>_PATH . 'app/class-wpdtrt-plugin.php'); // make into a composer include

  // extended classes:
  require_once(<%= constantStub %>_PATH . 'app/class-<%= name %>-template-loader.php');
  require_once(<%= constantStub %>_PATH . 'app/class-<%= name %>-plugin.php');
  require_once(<%= constantStub %>_PATH . 'app/class-<%= name %>-widget.php');

  require_once(<%= constantStub %>_PATH . 'config/tgm-plugin-activation.php');

  /**
   * Call init before widget_init so that the plugin object properties are available to it.
   *
   * If widget_init is not working when called via init with priority 1, try changing the priority of init to 0.
   *
   * init: Typically used by plugins to initialize. The current user is already authenticated by this time.
   * └─ widgets_init: Used to register sidebars. Fired at 'init' priority 1 (and so before 'init' actions with priority ≥ 1!)
   *
   * @see https://wp-mix.com/wordpress-widget_init-not-working/
   * @see https://codex.wordpress.org/Plugin_API/Action_Reference
   */
  add_action( 'init', 'wpdtrt_attachment_map_init', 0 );

  function wpdtrt_attachment_map_init() {

    // pass object reference between classes via global
    // because the object does not exist until the WordPress init action has fired
    global $wpdtrt_attachment_map_plugin;

    // hmm, not sure about this approach
    // as having shortcode and plugin tied together
    // means we can only have one shortcode per plugin
    $wpdtrt_attachment_map_plugin = new <%= nameFriendly %> (
      array(
        'prefix' => '<%= nameSafe %>',
        'slug' => '<%= name %>',
        'menu_title' => __('Attachment Map', '<%= name %>'),
        'developer_prefix' => 'DTRT',
        'shortcode_name' => '<%= nameSafe %>',
        'plugin_directory' => <%= constantStub %>_PATH,
        'option_defaults' => array(
          'google_maps_api_key' => '',
          'datatype' => 'photos'
        ),
        'shortcode_option_defaults' => array(
          'number' => '0',
          'enlargement' => '0' // 1 || 0
        )
      )
    );

  }

  /**
   * The register_activation_hook function registers a plugin function
   * to be run when the plugin is activated.
   *
   * @see https://codex.wordpress.org/Function_Reference/register_activation_hook
   *
   * @since     0.6.0
   * @version   1.0.0
   */
  register_activation_hook(__FILE__, '<%= nameSafe %>_activate');

  function <%= nameSafe %>_activate() {
    <%= nameSafe %>_rewrite_rules();
    flush_rewrite_rules();
  }

  /**
   * The function register_deactivation_hook (introduced in WordPress 2.0) registers a plugin function
   * to be run when the plugin is deactivated.
   *
   * @see https://codex.wordpress.org/Function_Reference/register_deactivation_hook
   *
   * @since     0.6.0
   * @version   1.0.0
   */
  register_deactivation_hook(__FILE__, '<%= nameSafe %>_deactivate');

  function <%= nameSafe %>_deactivate() {
    flush_rewrite_rules();
  }
?>
