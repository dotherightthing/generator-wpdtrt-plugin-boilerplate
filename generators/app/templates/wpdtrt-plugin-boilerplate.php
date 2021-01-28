<?php
/**
 * <%= nameFriendly %>
 *
 * @package     <%= nameFriendlySafe %>
 * @author      <%= authorName %>
 * @copyright   2021 Do The Right Thing
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
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
 * Group: Constants
 *
 * Note:
 * - WordPress makes use of the following constants when determining the path to the content and plugin directories.
 *   These should not be used directly by plugins or themes, but are listed here for completeness.
 * - WP_CONTENT_DIR  // no trailing slash, full paths only
 * - WP_CONTENT_URL  // full url
 * - WP_PLUGIN_DIR  // full path, no trailing slash
 * - WP_PLUGIN_URL  // full url, no trailing slash
 * - WordPress provides several functions for easily determining where a given file or directory lives.
 *   Always use these functions in your plugins instead of hard-coding references to the wp-content directory
 *   or using the WordPress internal constants.
 * - plugins_url()
 * - plugin_dir_url()
 * - plugin_dir_path()
 * - plugin_basename()
 *
 * See:
 * - <https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Constants>
 * - <https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Plugins>
 * _____________________________________
 */

if ( ! defined( '<%= constantStub %>_VERSION' ) ) {
	/**
	 * Constant: <%= constantStub %>_VERSION
	 *
	 * Plugin version.
	 *
	 * Note:
	 * - WP provides get_plugin_data(), but it only works within WP Admin,
	 *   so we define a constant instead.
	 *
	 * See:
	 * - <https://wordpress.stackexchange.com/questions/18268/i-want-to-get-a-plugin-version-number-dynamically>
	 *
	 * Example:
	 * ---php
	 * $plugin_data = get_plugin_data( __FILE__ ); $plugin_version = $plugin_data['Version'];
	 * ---
	 */
	define( '<%= constantStub %>_VERSION', '<%= defaultVersion %>' );
}

if ( ! defined( '<%= constantStub %>_PATH' ) ) {
	/**
	 * Constant: <%= constantStub %>_PATH
	 *
	 * Plugin directory filesystem path (with trailing slash).
	 *
	 * See:
	 * - <https://developer.wordpress.org/reference/functions/plugin_dir_path/>
	 * - <https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything>
	 */
	define( '<%= constantStub %>_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( '<%= constantStub %>_URL' ) ) {
	/**
	 * Constant: <%= constantStub %>_URL
	 *
	 * Plugin directory URL path (with trailing slash).
	 *
	 * See:
	 * - <https://codex.wordpress.org/Function_Reference/plugin_dir_url>
	 * - <https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything>
	 */
	define( '<%= constantStub %>_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Constant: WPDTRT_PLUGIN_CHILD
 *
 * Boolean, used to determine the correct path to the PSR-4 autoloader.
 *
 * See:
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/51>
 */
if ( ! defined( 'WPDTRT_PLUGIN_CHILD' ) ) {
	define( 'WPDTRT_PLUGIN_CHILD', true );
}

/**
 * Determine the correct path to the PSR-4 autoloader.
 *
 * See:
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/104>
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Options:-Adding-WordPress-plugin-dependencies>
 */
if ( defined( '<%= constantStub %>_TEST_DEPENDENCY' ) ) {
	$project_root_path = realpath( __DIR__ . '/../../..' ) . '/';
} else {
	$project_root_path = '';
}

require_once $project_root_path . 'vendor/autoload.php';

/**
 * Replace the TGMPA autoloader
 *
 * See:
 * - <https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate#77>
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate#136>
 */
if ( is_admin() ) {
	require_once $project_root_path . 'vendor/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php';
}

// sub classes, not loaded via PSR-4.
// remove the includes you don't need, edit the files you do need.
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-plugin.php';
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-rewrite.php';
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-shortcode.php';
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-taxonomy.php';
require_once <%= constantStub %>_PATH . 'src/class-<%= name %>-widget.php';

// log & trace helpers.
global $debug;
$debug = new DoTheRightThing\WPDebug\Debug();

/**
 * Group: WordPress Integration
 *
 * Comment out the actions you don't need.
 *
 * Notes:
 *  Default priority is 10. A higher priority runs later.
 *  register_activation_hook() is run before any of the provided hooks
 *
 * See:
 * - <https://developer.wordpress.org/plugins/hooks/actions/#priority>
 * - <https://codex.wordpress.org/Function_Reference/register_activation_hook>
 * _____________________________________
 */

register_activation_hook( dirname( __FILE__ ), '<%= nameSafe %>_activate' );

add_action( 'init', '<%= nameSafe %>_plugin_init', 0 );
add_action( 'init', '<%= nameSafe %>_shortcode_init', 100 );
add_action( 'init', '<%= nameSafe %>_taxonomy_init', 100 );
add_action( 'widgets_init', '<%= nameSafe %>_widget_init', 10 );

register_deactivation_hook( dirname( __FILE__ ), '<%= nameSafe %>_deactivate' );

/**
 * Group: Plugin config
 * _____________________________________
 */

/**
 * Function: <%= nameSafe %>_activate
 *
 * Register functions to be run when the plugin is activated.
 *
 * Note:
 * - See also Plugin::helper_flush_rewrite_rules()
 *
 * See:
 * - <https://codex.wordpress.org/Function_Reference/register_activation_hook>
 *
 * TODO:
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/128>
 */
function <%= nameSafe %>_activate() {
	flush_rewrite_rules();
}

/**
 * Function: <%= nameSafe %>_deactivate
 *
 * Register functions to be run when the plugin is deactivated (WordPress 2.0+).
 *
 * Note:
 * - See also Plugin::helper_flush_rewrite_rules()
 *
 * See:
 * - <https://codex.wordpress.org/Function_Reference/register_deactivation_hook>
 *
 * TODO:
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/128>
 */
function <%= nameSafe %>_deactivate() {
	flush_rewrite_rules();
}

/**
 * Function: <%= nameSafe %>_plugin_init
 *
 * Plugin initialisaton.
 *
 * Note:
 * - We call init before widget_init so that the plugin object properties are available to it.
 * - If widget_init is not working when called via init with priority 1, try changing the priority of init to 0.
 * - init: Typically used by plugins to initialize. The current user is already authenticated by this time.
 * - widgets_init: Used to register sidebars. Fired at 'init' priority 1 (and so before 'init' actions with priority ≥ 1!)
 *
 * See:
 * - <https://wp-mix.com/wordpress-widget_init-not-working/>
 * - <https://codex.wordpress.org/Plugin_API/Action_Reference>
 *
 * TODO:
 * - Add a constructor function to <%= nameFriendlySafe %>_Plugin, to explain the options array
 */
function <%= nameSafe %>_plugin_init() {
	// pass object reference between classes via global
	// because the object does not exist until the WordPress init action has fired.
	global $<%= nameSafe %>_plugin;

	/**
	 * Array: plugin_options
	 *
	 * Global options.
	 *
	 * See:
	 * - <Options - Adding global options: https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Options:-Adding-global-options>
	 */
	$plugin_options = array(
		'pluginoption1' => array(
			'type'    => 'text',
			'label'   => __( 'Field label', '<%= name %>' ),
			'size'    => 10,
			'tip'     => __( 'Helper text', '<%= name %>' ),
			'default' => 'Fallback value',
		),
	);

	/**
	 * Array: instance_options
	 *
	 * Shortcode or Widget options.
	 *
	 * See:
	 * - <Options - Adding shortcode or widget options: https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Options:-Adding-shortcode-or-widget-options>
	 */
	$instance_options = array(
		'instanceoption1' => array(
			'type'    => 'text',
			'label'   => __( 'Field label', '<%= name %>' ),
			'size'    => 10,
			'tip'     => __( 'Helper text', '<%= name %>' ),
			'default' => '',
		),
	);

	$plugin_dependencies = array();

	/**
	 * Array: ui_messages
	 *
	 * UI Messages.
	 */
	$ui_messages = array(
		'demo_data_description'       => __( 'This demo was generated from the following data', '<%= name %>' ),
		'demo_data_displayed_length'  => __( 'results displayed', '<%= name %>' ),
		'demo_data_length'            => __( 'results', '<%= name %>' ),
		'demo_data_title'             => __( 'Demo data', '<%= name %>' ),
		'demo_date_last_updated'      => __( 'Data last updated', '<%= name %>' ),
		'demo_sample_title'           => __( 'Demo sample', '<%= name %>' ),
		'demo_shortcode_title'        => __( 'Demo shortcode', '<%= name %>' ),
		'insufficient_permissions'    => __( 'Sorry, you do not have sufficient permissions to access this page.', '<%= name %>' ),
		'no_options_form_description' => __( 'There aren\'t currently any options.', '<%= name %>' ),
		'noscript_warning'            => __( 'Please enable JavaScript', '<%= name %>' ),
		'options_form_description'    => __( 'Please enter your preferences.', '<%= name %>' ),
		'options_form_submit'         => __( 'Save Changes', '<%= name %>' ),
		'options_form_title'          => __( 'General Settings', '<%= name %>' ),
		'loading'                     => __( 'Loading latest data...', '<%= name %>' ),
		'success'                     => __( 'settings successfully updated', '<%= name %>' ),
	);

	/**
	 * Array: demo_shortcode_params
	 *
	 * Demo shortcode.
	 *
	 * See:
	 * - <Settings page - Adding a demo shortcode: https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Settings-page:-Adding-a-demo-shortcode>
	 */
	$demo_shortcode_params = array();

	/**
	 * Plugin configuration
	 */
	$<%= nameSafe %>_plugin = new <%= nameFriendlySafe %>_Plugin(
		array(
			'path'                  => <%= constantStub %>_PATH,
			'url'                   => <%= constantStub %>_URL,
			'version'               => <%= constantStub %>_VERSION,
			'prefix'                => '<%= nameSafe %>',
			'slug'                  => '<%= name %>',
			'menu_title'            => __( '<%= nameAdminMenu %>', '<%= name %>' ),
			'settings_title'        => __( 'Settings', '<%= name %>' ),
			'developer_prefix'      => '<%= authorAbbreviation %>',
			'messages'              => $ui_messages,
			'plugin_options'        => $plugin_options,
			'instance_options'      => $instance_options,
			'plugin_dependencies'   => $plugin_dependencies,
			'demo_shortcode_params' => $demo_shortcode_params,
		)
	);
}

/**
 * Group: Rewrite config
 */

/**
 * Function: <%= nameSafe %>_rewrite_init
 *
 * Register Rewrite.
 */
function <%= nameSafe %>_rewrite_init() {

	global $<%= nameSafe %>_plugin;

	$<%= nameSafe %>_rewrite = new <%= nameFriendlySafe %>_Rewrite(
		array()
	);
}

/**
 * Group: Shortcode config
 */

/**
 * Function: <%= nameSafe %>_shortcode_init
 *
 * Register Shortcode.
 */
function <%= nameSafe %>_shortcode_init() {

	global $<%= nameSafe %>_plugin;

	$<%= nameSafe %>_shortcode = new <%= nameFriendlySafe %>_Shortcode(
		array(
			'name'                      => '<%= nameSafe %>_shortcode',
			'plugin'                    => $<%= nameSafe %>_plugin,
			'template'                  => '<%= nameTemplate %>',
			'selected_instance_options' => array(
				'instanceoption1',
			),
		)
	);
}

/**
 * Group: Taxonomy config
 */

/**
 * Function: <%= nameSafe %>_taxonomy_init
 *
 * Register Taxonomy.
 *
 * Returns:
 *   object - Taxonomy/
 */
function <%= nameSafe %>_taxonomy_init() {

	global $<%= nameSafe %>_plugin;

	$<%= nameSafe %>_taxonomy = new <%= nameFriendlySafe %>_Taxonomy(
		array(
			'name'                      => '<%= nameSafe %>_things',
			'plugin'                    => $<%= nameSafe %>_plugin,
			'selected_instance_options' => array(
				'instanceoption1',
			),
			'taxonomy_options'          => array(
				'option1' => array(
					'type'              => 'text',
					'label'             => esc_html__( 'Option 1', '<%= name %>' ),
					'admin_table'       => true,
					'admin_table_label' => esc_html__( '1', '<%= name %> ' ),
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
 * Group: Widget config
 */

/**
 * Function: <%= nameSafe %>_widget_init
 *
 * Register a WordPress widget, passing in an instance of our custom widget class.
 *
 * Note:
 * - The plugin does not require registration, but widgets and shortcodes do.
 * - widget_init fires before init, unless init has a priority of 0
 *
 * Uses:
 *   ../../../../wp-includes/widgets.php
 *   https://github.com/dotherightthing/wpdtrt/tree/master/library/sidebars.php
 *
 * See:
 * - <https://codex.wordpress.org/Function_Reference/register_widget#Example>
 * - <https://wp-mix.com/wordpress-widget_init-not-working/>
 * - <https://codex.wordpress.org/Plugin_API/Action_Reference>
 *
 * TODO:
 * - Add form field parameters to the options array
 * - Investigate the 'classname' option
 */
function <%= nameSafe %>_widget_init() {

	global $<%= nameSafe %>_plugin;

	$<%= nameSafe %>_widget = new <%= nameFriendlySafe %>_Widget(
		array(
			'name'                      => '<%= nameSafe %>_widget',
			'title'                     => __( '<%= nameFriendly %> Widget', '<%= name %>' ),
			'description'               => __( '<%= description %>', '<%= name %>' ),
			'plugin'                    => $<%= nameSafe %>_plugin,
			'template'                  => '<%= nameTemplate %>',
			'selected_instance_options' => array(
				'instanceoption1',
			),
		)
	);

	register_widget( $<%= nameSafe %>_widget );
}
