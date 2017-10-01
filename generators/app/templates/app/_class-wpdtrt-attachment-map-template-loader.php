<?php
/**
 * Template loader
 *
 * Displays templates in the Templates dropdown in the page edit screen
 * Allows the author to override these from the templates folder in their own theme
 *
 *
 * @uses 		https://github.com/wpexplorer/page-templater
 * @see 		http://www.wpexplorer.com/wordpress-page-templates-plugin/
 * @todo 		See wpdtrt-responsive-nav-shortcodes.php for usage
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 * @since       0.6.0
 * @version 	1.0.0
 * @todo Make name generic for class-wpdtrt-plugin.php
 */

/**
 * Only need to specify class properties here.
 */
class <%= nameFriendlySafe %>_Template_Loader extends Gamajo_Template_Loader {

	/**
	 * Prefix for filter names.
	 */
	protected $filter_prefix = '<%= name %>';

	/**
	 * Directory name where custom templates for this plugin should be found in the plugin.
	 */
	protected $plugin_template_directory = 'template-parts/<%= name %>';

	/**
	 * Directory name where custom templates for this plugin should be found in the theme.
	 */
	protected $theme_template_directory = 'template-parts/<%= name %>';

	/**
	 * Reference to the root directory path of this plugin.
	 */
	protected $plugin_directory = <%= constantStub %>_PATH;

}

?>
