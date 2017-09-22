<?php
/**
 * Admin Notices
 *
 * This file contains PHP.
 *
 * @link        <%= pluginUrl %>
 * @since       0.1.0
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 */

/**
 * Display any error messages below the H1
 * @see https://digwp.com/2016/05/wordpress-admin-notices/
 */
add_action('admin_notices', '<%= nameSafe %>_add_settings_errors');

function <%= nameSafe %>_add_settings_errors() {
    settings_errors();
}

/**
 * Display a custom admin notice below the H1
 * Possible classes: notice-error, notice-warning, notice-success, or notice-info
 * @see https://digwp.com/2016/05/wordpress-admin-notices/
 */
add_action('admin_notices', '<%= nameSafe %>_admin_notice_settings_updated');

function <%= nameSafe %>_admin_notice_settings_updated() {

	$screen = get_current_screen();

	if ($screen->id === 'settings_page_<%= nameSafe %>'):

		if ( isset( $_POST['<%= nameSafe %>_form_submitted'] ) ):
?>

			<div class="notice notice-success is-dismissible">
				<p><?php _e('Boilerplate settings successfully updated', '<%= name %>'); ?></p>
			</div>

<?php
		endif;
	endif;
}
?>