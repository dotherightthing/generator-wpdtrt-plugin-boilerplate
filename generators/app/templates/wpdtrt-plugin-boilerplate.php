<?php
/**
 * Plugin Name:  <%= nameFriendly %>
 * Plugin URI:   <%= pluginUrl %>
 * Description:  <%= description %>
 * Version:      0.0.1
 * Author:       <%= authorName %>
 * Author URI:   <%= authorUrl %>
 * License:      <%= pluginLicense %>
 * License URI:  <%= pluginLicenseUrl %>
 * Text Domain:  <%= name %>
 * Domain Path:  /languages
 */

require_once plugin_dir_path( __FILE__ ) . "vendor/autoload.php";

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
  * Determine the correct path to the autoloader
  * @see https://github.com/dotherightthing/wpdtrt-plugin/issues/51
  */
if( ! defined( 'WPDTRT_PLUGIN_CHILD' ) ) {
  define( 'WPDTRT_PLUGIN_CHILD', true );
}

if( ! defined( '<%= constantStub %>_VERSION' ) ) {
/**
 * Plugin version.
 *
 * WP provides get_plugin_data(), but it only works within WP Admin,
 * so we define a constant instead.
 *
 * @example $plugin_data = get_plugin_data( __FILE__ ); $plugin_version = $plugin_data['Version'];
 * @link https://wordpress.stackexchange.com/questions/18268/i-want-to-get-a-plugin-version-number-dynamically
 *
 * @version   0.0.1
 * @since     <%= generatorVersion %>
 */
  define( '<%= constantStub %>_VERSION', '0.0.1' );
}

if( ! defined( '<%= constantStub %>_PATH' ) ) {
/**
 * Plugin directory filesystem path.
 *
 * @param string $file
 * @return The filesystem directory path (with trailing slash)
 *
 * @link https://developer.wordpress.org/reference/functions/plugin_dir_path/
 * @link https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
 *
 * @version   0.0.1
 * @since     <%= generatorVersion %>
 */
  define( '<%= constantStub %>_PATH', plugin_dir_path( __FILE__ ) );
}

if( ! defined( '<%= constantStub %>_URL' ) ) {
/**
 * Plugin directory URL path.
 *
 * @param string $file
 * @return The URL (with trailing slash)
 *
 * @link https://codex.wordpress.org/Function_Reference/plugin_dir_url
 * @link https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
 *
 * @version   0.0.1
 * @since     <%= generatorVersion %>
 */
  define( '<%= constantStub %>_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Include plugin logic
 *
 * @version   0.0.1
 * @since     <%= generatorVersion %>
 */

  // base class
  // redundant, but includes the composer-generated autoload file if not already included
  require_once(<%= constantStub %>_PATH . 'vendor/dotherightthing/wpdtrt-plugin/index.php');

  // classes without composer.json files are loaded via Bower
  //require_once(<%= constantStub %>_PATH . 'vendor/name/file.php');

  // sub classes
  require_once(<%= constantStub %>_PATH . 'src/class-<%= name %>-plugin.php');
  require_once(<%= constantStub %>_PATH . 'src/class-<%= name %>-widgets.php');

  // log & trace helpers
  $debug = new DoTheRightThing\WPDebug\Debug;

  /**
   * Plugin initialisaton
   *
   * We call init before widget_init so that the plugin object properties are available to it.
   * If widget_init is not working when called via init with priority 1, try changing the priority of init to 0.
   * init: Typically used by plugins to initialize. The current user is already authenticated by this time.
   * └─ widgets_init: Used to register sidebars. Fired at 'init' priority 1 (and so before 'init' actions with priority ≥ 1!)
   *
   * @see https://wp-mix.com/wordpress-widget_init-not-working/
   * @see https://codex.wordpress.org/Plugin_API/Action_Reference
   * @todo Add a constructor function to <%= nameFriendlySafe %>_Plugin, to explain the options array
   */
  function <%= nameSafe %>_init() {
    // pass object reference between classes via global
    // because the object does not exist until the WordPress init action has fired
    global $<%= nameSafe %>_plugin;

    /**
     * Admin settings
     * For array syntax, please view the field documentation:
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-checkbox.php
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-number.php
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-password.php
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-select.php
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-text.php
     */
    $plugin_options = array(
      'pluginoption1' => array(
        'type' => 'text',
        'label' => __('Field label', '<%= name %>'),
        'size' => 10,
        'tip' => __('Helper text', '<%= name %>')
      )
    );

    /**
     * All options available to Widgets and Shortcodes
     * For array syntax, please view the field documentation:
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-checkbox.php
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-number.php
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-password.php
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-select.php
     * @see https://github.com/dotherightthing/wpdtrt-plugin/blob/master/views/form-element-text.php
     */
    $instance_options = array(
      'instanceoption1' => array(
        'type' => 'text',
        'label' => __('Field label', '<%= name %>'),
        'size' => 10,
        'tip' => __('Helper text', '<%= name %>')
      )
    );

    $<%= nameSafe %>_plugin = new <%= nameFriendlySafe %>_Plugin(
      array(
        'url' => <%= constantStub %>_URL,
        'prefix' => '<%= nameSafe %>',
        'slug' => '<%= name %>',
        'menu_title' => __('<%= nameAdminMenu %>', '<%= name %>'),
        'developer_prefix' => '<%= authorAbbreviation %>',
        'path' => <%= constantStub %>_PATH,
        'messages' => array(
          'loading' => __('Loading latest data...', '<%= name %>'),
          'success' => __('settings successfully updated', '<%= name %>'),
          'insufficient_permissions' => __('Sorry, you do not have sufficient permissions to access this page.', '<%= name %>'),
          'noscript_warning' => __('JavaScript is disabled. Please enable JavaScript to load demo data.', '<%= name %>'),
          'options_form_title' => __('General Settings', '<%= name %>'),
          'options_form_description' => __('Please enter your preferences', '<%= name %>'),
          'options_form_submit' => __('Save Changes', '<%= name %>')
        ),
        'plugin_options' => $plugin_options,
        'instance_options' => $instance_options,
        'version' => <%= constantStub %>_VERSION,
        /*
        'plugin_dependencies' => array(
          array(
            'name'          => 'Plugin Name',
            'slug'          => 'plugin-name',
            'source'        => 'https://github.com/user/library/archive/master.zip',
            'required'      => true,
            'is_callable'   => 'function_name'
          )
        ),
        */
        'demo_shortcode_params' => null
      )
    );
  }

  add_action( 'init', '<%= nameSafe %>_init', 0 );

  /**
   * Register a WordPress widget, passing in an instance of our custom widget class
   * The plugin does not require registration, but widgets and shortcodes do.
   * Note: widget_init fires before init, unless init has a priority of 0
   *
   * @uses        ../../../../wp-includes/widgets.php
   * @see         https://codex.wordpress.org/Function_Reference/register_widget#Example
   * @see         https://wp-mix.com/wordpress-widget_init-not-working/
   * @see         https://codex.wordpress.org/Plugin_API/Action_Reference
   * @uses        https://github.com/dotherightthing/wpdtrt/tree/master/library/sidebars.php
   *
   * @version     0.0.1
   * @since       <%= generatorVersion %>
   * @todo        Add form field parameters to the options array
   * @todo        Investigate the 'classname' option
   */
  function <%= nameSafe %>_widget_1_init() {

    global $<%= nameSafe %>_plugin;

    $<%= nameSafe %>_widget_1 = new <%= nameFriendlySafe %>_Widget_1(
      array(
        'name' => '<%= nameSafe %>_widget_1',
        'title' => __('<%= authorAbbreviation %> <%= nameAdminMenu %> Widget', '<%= name %>'),
        'description' => __('<%= description %>.', '<%= name %>'),
        'plugin' => $<%= nameSafe %>_plugin,
        'template' => '<%= nameTemplate %>',
        'selected_instance_options' => array(
          'instanceoption1'
        )
      )
    );

    register_widget( $<%= nameSafe %>_widget_1 );
  }

  add_action( 'widgets_init', '<%= nameSafe %>_widget_1_init' );

  /**
   * Register Shortcode
   */
  function <%= nameSafe %>_shortcode_1_init() {

    global $<%= nameSafe %>_plugin;

    $<%= nameSafe %>_shortcode_1 = new DoTheRightThing\WPPlugin\Shortcode(
      array(
        'name' => '<%= nameSafe %>_shortcode_1',
        'plugin' => $<%= nameSafe %>_plugin,
        'template' => '<%= nameTemplate %>',
        'selected_instance_options' => array(
          'instanceoption1'
        )
      )
    );
  }

  add_action( 'init', '<%= nameSafe %>_shortcode_1_init', 100 );

  /**
   * Register functions to be run when the plugin is activated.
   *
   * @see https://codex.wordpress.org/Function_Reference/register_activation_hook
   *
   * @version   0.0.1
   * @since     <%= generatorVersion %>
   */
  function <%= nameSafe %>_activate() {
    //<%= nameSafe %>_rewrite_rules();
    flush_rewrite_rules();
  }

  register_activation_hook(__FILE__, '<%= nameSafe %>_activate');

  /**
   * Register functions to be run when the plugin is deactivated.
   *
   * (WordPress 2.0+)
   *
   * @see https://codex.wordpress.org/Function_Reference/register_deactivation_hook
   *
   * @version   0.0.1
   * @since     <%= generatorVersion %>
   */
  function <%= nameSafe %>_deactivate() {
    flush_rewrite_rules();
  }

  register_deactivation_hook(__FILE__, '<%= nameSafe %>_deactivate');

?>
