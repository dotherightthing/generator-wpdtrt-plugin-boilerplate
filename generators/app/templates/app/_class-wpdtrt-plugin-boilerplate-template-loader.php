<?php
/**
 * Template loader
 *
 * Displays templates in the Templates dropdown in the page edit screen
 * Allows the author to override these from the templates folder in their own theme
 *
 * @uses https://github.com/wpexplorer/page-templater
 * @see http://www.wpexplorer.com/wordpress-page-templates-plugin/
 * @version: 1.1.0
 * @author: WPExplorer
 *
 * @todo See wpdtrt-responsive-nav-shortcodes.php for usage
*/

require_once(<%= constantStub %>_PATH . 'vendor/gamajo/template-loader/class-gamajo-template-loader.php');

/**
 * Only need to specify class properties here.
 */
class <%= nameFriendlySafe %>_Template_Loader extends Gamajo_Template_Loader {

	/**
	 * Prefix for filter names.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $filter_prefix = '<%= name %>';

	/**
	 * Directory name where custom templates for this plugin should be found in the plugin.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $plugin_template_directory = 'template-parts/<%= name %>';

	/**
	 * Directory name where custom templates for this plugin should be found in the theme.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $theme_template_directory = 'template-parts/<%= name %>';

	/**
	 * Reference to the root directory path of this plugin.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $plugin_directory = <%= constantStub %>_PATH;

}
