<?php
/**
 * Plugin Name:  <%= nameFriendly %>
 * Plugin URI:   <%= homepage %>
 * Description:  <%= description %>
 * Version:      <%= defaultVersion %>
 * Author:       <%= authorName %>
 * Author URI:   <%= authorUrl %>
 * License:      <%= pluginLicense %>
 * License URI:  <%= pluginLicenseUrl %>
 * Text Domain:  <%= name %>
 * Domain Path:  /languages
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
 * @see https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Constants
 * @see https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Plugins
 */

if ( ! defined( '<%= constantStub %>_VERSION' ) ) {
	/**
	 * Plugin version.
	 *
	 * WP provides get_plugin_data(), but it only works within WP Admin,
	 * so we define a constant instead.
	 *
	 * @since     1.0.0
	 * @version   1.0.0
	 * @see $plugin_data = get_plugin_data( __FILE__ ); $plugin_version = $plugin_data['Version'];
	 * @see https://wordpress.stackexchange.com/questions/18268/i-want-to-get-a-plugin-version-number-dynamically
	 */
	define( '<%= constantStub %>_VERSION', '<%= defaultVersion %>' );
}

if ( ! defined( '<%= constantStub %>_PATH' ) ) {
	/**
	 * Plugin directory filesystem path.
	 *
	 * @param string $file
	 * @return The filesystem directory path (with trailing slash)
	 * @since     1.0.0
	 * @version   1.0.0
	 * @see https://developer.wordpress.org/reference/functions/plugin_dir_path/
	 * @see https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
	 */
	define( '<%= constantStub %>_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( '<%= constantStub %>_URL' ) ) {
	/**
	 * Plugin directory URL path.
	 *
	 * @param string $file
	 * @return The URL (with trailing slash)
	 * @since     1.0.0
	 * @version   1.0.0
	 * @see https://codex.wordpress.org/Function_Reference/plugin_dir_url
	 * @see https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
	 */
	define( '<%= constantStub %>_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * ===== Dependencies =====
 */

/**
 * Determine the correct path, from wpdtrt-plugin to the PSR-4 autoloader.
 *
 * @see https://github.com/dotherightthing/wpdtrt-plugin/issues/51
 */
if ( ! defined( 'WPDTRT_PLUGIN_CHILD' ) ) {
	define( 'WPDTRT_PLUGIN_CHILD', true );
}

/**
 * Determine the correct path, from wpdtrt-foobar to the PSR-4 autoloader.
 *
 * @see https://github.com/dotherightthing/wpdtrt-plugin/issues/104
 * @see https://github.com/dotherightthing/wpdtrt-plugin/wiki/Options:-Adding-WordPress-plugin-dependencies
 */
if ( defined( '<%= constantStub %>_TEST_DEPENDENCY' ) ) {
	$project_root_path = realpath( __DIR__ . '/../../..' ) . '/';
} else {
	$project_root_path = '';
}

require_once $project_root_path . 'vendor/autoload.php';

// sub classes, not loaded via PSR-4.
// comment out the ones you don't need, edit the ones you do.
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-plugin.php';
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-rewrite.php';
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-shortcode.php';
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-taxonomy.php';
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-widget.php';

// log & trace helpers.
global $debug;
$debug = new DoTheRightThing\WPDebug\Debug;

/**
 * ===== WordPress Integration =====
 *
 * Notes:
 *  Default priority is 10. A higher priority runs later.
 *  register_activation_hook() is run before any of the provided hooks
 *
 * @see https://developer.wordpress.org/plugins/hooks/actions/#priority
 * @see https://codex.wordpress.org/Function_Reference/register_activation_hook.
 */
register_activation_hook( dirname( __FILE__ ), '<%= nameSafe %>_activate' );

add_action( 'init', '<%= nameSafe %>_plugin_init', 0 );
add_action( 'init', '<%= nameSafe %>_shortcode_init', 100 );
add_action( 'init', '<%= nameSafe %>_taxonomy_init', 100 );
add_action( 'widgets_init', '<%= nameSafe %>_widget_init', 10 );

register_deactivation_hook( dirname( __FILE__ ), '<%= nameSafe %>_deactivate' );

/**
 * ===== Plugin config =====
 */

/**
 * Register functions to be run when the plugin is activated.
 *
 * @since     0.6.0
 * @version   1.0.0
 * @see https://codex.wordpress.org/Function_Reference/register_activation_hook
 * @todo https://github.com/dotherightthing/wpdtrt-plugin/issues/128
 * @see See also Plugin::helper_flush_rewrite_rules()
 */
function <%= nameSafe %>_activate() {
	flush_rewrite_rules();
}

/**
 * Register functions to be run when the plugin is deactivated.
 * (WordPress 2.0+)
 *
 * @since     0.6.0
 * @version   1.0.0
 * @see https://codex.wordpress.org/Function_Reference/register_deactivation_hook
 * @todo https://github.com/dotherightthing/wpdtrt-plugin/issues/128
 * @see See also Plugin::helper_flush_rewrite_rules()
 */
function <%= nameSafe %>_deactivate() {
	flush_rewrite_rules();
}

/**
 * Plugin initialisaton
 *
 * We call init before widget_init so that the plugin object properties are available to it.
 * If widget_init is not working when called via init with priority 1, try changing the priority of init to 0.
 * init: Typically used by plugins to initialize. The current user is already authenticated by this time.
 * widgets_init: Used to register sidebars. Fired at 'init' priority 1 (and so before 'init' actions with priority ≥ 1!)
 *
 * @see https://wp-mix.com/wordpress-widget_init-not-working/
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference
 * @todo Add a constructor function to WPDTRT_Blocks_Plugin, to explain the options array
 */
  function <%= nameSafe %>_init() {
	// pass object reference between classes via global
	// because the object does not exist until the WordPress init action has fired
	global $wpdtrt_test_plugin;

	/**
	 * Global options
	 *
	 * @see https://github.com/dotherightthing/wpdtrt-plugin/wiki/Options:-Adding-global-options
	 */
	$plugin_options = array(
		'pluginoption1' => array(
			'type'  => 'text',
			'label' => __('Field label', '<%= name %>'),
			'size'  => 10,
			'tip'   => __('Helper text', '<%= name %>')
		)
	);

	/**
	 * Shortcode or Widget options
	 *
	 * @see https://github.com/dotherightthing/wpdtrt-plugin/wiki/Options:-Adding-shortcode-or-widget-options
	 * @see https://github.com/dotherightthing/wpdtrt-plugin/wiki/Options:-Adding-WordPress-plugin-dependencies
	 */
	$instance_options = array(
		'instanceoption1' => array(
			'type'  => 'text',
			'label' => __('Field label', '<%= name %>'),
			'size'  => 10,
			'tip'   => __('Helper text', '<%= name %>')
		)
	);

	/**
	 * Plugin configuration
	 *
	 * @see https://github.com/dotherightthing/wpdtrt-plugin/wiki/Options:-Adding-WordPress-plugin-dependencies
	 */
	$<%= nameSafe %>_plugin = new <%= nameFriendlySafe %>_Plugin(
		array(
			'url'              => <%= constantStub %>_URL,
			'prefix'           => '<%= nameSafe %>',
			'slug'             => '<%= name %>',
			'menu_title'       => __('<%= nameAdminMenu %>', '<%= name %>'),
			'settings_title'   => __('Settings', '<%= name %>'),
			'developer_prefix' => '<%= authorAbbreviation %>',
			'path'             => <%= constantStub %>_PATH,
			'messages'         => array(
				'loading'                     => __( 'Loading latest data...', '<%= name %>' ),
				'success'                     => __( 'settings successfully updated', '<%= name %>' ),
				'insufficient_permissions'    => __( 'Sorry, you do not have sufficient permissions to access this page.', '<%= name %>' ),
				'options_form_title'          => __( 'General Settings', '<%= name %>' ),
				'options_form_description'    => __( 'Please enter your preferences.', '<%= name %>' ),
				'no_options_form_description' => __( 'There aren\'t currently any options.', '<%= name %>' ),
				'options_form_submit'         => __( 'Save Changes', '<%= name %>' ),
				'noscript_warning'            => __( 'Please enable JavaScript', '<%= name %>' ),
				'demo_sample_title'           => __( 'Demo sample', '<%= name %>' ),
				'demo_data_title'             => __( 'Demo data', '<%= name %>' ),
				'demo_shortcode_title'        => __( 'Demo shortcode', '<%= name %>' ),
				'demo_data_description'       => __( 'This demo was generated from the following data', '<%= name %>' ),
				'demo_date_last_updated'      => __( 'Data last updated', '<%= name %>' ),
				'demo_data_length'            => __( 'results', '<%= name %>' ),
				'demo_data_displayed_length'  => __( 'results displayed', '<%= name %>' ),
			),
			'plugin_options'   => $plugin_options,
			'instance_options' => $instance_options,
			'version'          => <%= constantStub %>_VERSION,
		)
	);
}

/**
 * ===== Rewrite config =====
 */

/**
 * Register Rewrite
 */
function <%= nameSafe %>_rewrite_init() {

	global $<%= nameSafe %>_plugin;

	$<%= nameSafe %>_rewrite = new <%= nameFriendlySafe %>_Rewrite();
}

/**
 * ===== Shortcode config =====
 */

/**
 * Register Shortcode
 */
function <%= nameSafe %>_shortcode_init() {

	global $<%= nameSafe %>_plugin;

	$<%= nameSafe %>_shortcode = new <%= nameFriendlySafe %>_Shortcode(
		array(
			'name'                      => '<%= nameSafe %>_shortcode',
			'plugin'                    => $<%= nameSafe %>_plugin,
			'template'                  => '<%= nameTemplate %>',
			'selected_instance_options' => array(),
		)
	);
}

/**
 * ===== Taxonomy config =====
 */

/**
 * Register Taxonomy
 *
 * @return object Taxonomy/
 */
function <%= nameSafe %>_taxonomy_init() {

	global $<%= nameSafe %>_plugin;

	$<%= nameSafe %>_taxonomy = new <%= nameFriendlySafe %>_Taxonomy(
		array(
			'name'                      => '<%= nameSafe %>_things',
			'plugin'                    => $<%= nameSafe %>_plugin,
			'selected_instance_options' => array(),
			'taxonomy_options'          => array(
				'option1' => array(
					'type'              => 'text',
					'label'             => esc_html__( 'Option 1', '<%= name %>' ),
					'admin_table'       => true,
					'admin_table_label' => esc_html__( 'Opt 1', '<%= name %> ' ),
					'admin_table_sort'  => true,
					'tip'               => 'Enter something',
					'todo_condition'    => 'foo !== "bar"',
				),
			),
			'labels'                    => array(
				'slug'                       => '<%= nameSafe %>_thing',
				'description'                => __( 'Things', '<%= name %>' ),
				'posttype'                   => 'post',
				'name'                       => __( 'Things', 'taxonomy general name' ),
				'singular_name'              => _x( 'Thing', 'taxonomy singular name' ),
				'menu_name'                  => __( 'Things', '<%= name %>' ),
				'all_items'                  => __( 'All Things', '<%= name %>' ),
				'add_new_item'               => __( 'Add New Thing', '<%= name %>' ),
				'edit_item'                  => __( 'Edit Thing', '<%= name %>' ),
				'view_item'                  => __( 'View Thing', '<%= name %>' ),
				'update_item'                => __( 'Update Thing', '<%= name %>' ),
				'new_item_name'              => __( 'New Thing Name', '<%= name %>' ),
				'parent_item'                => __( 'Parent Thing', '<%= name %>' ),
				'parent_item_colon'          => __( 'Parent Thing:', '<%= name %>' ),
				'search_items'               => __( 'Search Things', '<%= name %>' ),
				'popular_items'              => __( 'Popular Things', '<%= name %>' ),
				'separate_items_with_commas' => __( 'Separate Things with commas', '<%= name %>' ),
				'add_or_remove_items'        => __( 'Add or remove Things', '<%= name %>' ),
				'choose_from_most_used'      => __( 'Choose from most used Things', '<%= name %>' ),
				'not_found'                  => __( 'No Things found', '<%= name %>' ),
			),
		)
	);

	// return a reference for unit testing.
	return $<%= nameSafe %>_taxonomy;
}

/**
 * ===== Widget config =====
 */

/**
 * Register a WordPress widget, passing in an instance of our custom widget class
 * The plugin does not require registration, but widgets and shortcodes do.
 * Note: widget_init fires before init, unless init has a priority of 0
 *
 * @since       0.7.6
 * @version     0.0.1
 * @uses        ../../../../wp-includes/widgets.php
 * @see         https://codex.wordpress.org/Function_Reference/register_widget#Example
 * @see         https://wp-mix.com/wordpress-widget_init-not-working/
 * @see         https://codex.wordpress.org/Plugin_API/Action_Reference
 * @uses        https://github.com/dotherightthing/wpdtrt/tree/master/library/sidebars.php
 * @todo        Add form field parameters to the options array
 * @todo        Investigate the 'classname' option
 */
function <%= nameSafe %>_widget_init() {

	global $<%= nameSafe %>_plugin;

	$<%= nameSafe %>_widget = new <%= nameFriendlySafe %>_Widget(
		array(
			'name'                      => '<%= nameSafe %>_widget',
			'title'                     => __( '<%= nameFriendly %> Widget', '<%= name %>' ),
			'description'               => __( 'Widget description.', '<%= name %>' ),
			'plugin'                    => $<%= nameSafe %>_plugin,
			'template'                  => '<%= nameTemplate %>',
			'selected_instance_options' => array(),
		)
	);

	register_widget( $<%= nameSafe %>_widget );
}
