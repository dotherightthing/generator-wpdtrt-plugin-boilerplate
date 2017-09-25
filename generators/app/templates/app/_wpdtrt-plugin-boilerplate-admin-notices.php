<?php
/**
 * Admin Notices
 * Displayed below the H1
 *
 * @see 		https://digwp.com/2016/05/wordpress-admin-notices/
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 * @since       0.6.0
 */

/**
 * Admin Notices: Errors
 *
 * @since       0.6.0
 * @version 	1.0.0
 */
add_action('admin_notices', '<%= nameSafe %>_add_settings_errors');

function <%= nameSafe %>_add_settings_errors() {
    settings_errors();
}

/**
 * Admin Notices: Custom
 * Possible classes: notice-error, notice-warning, notice-success, or notice-info
 *
 * @since       0.6.0
 * @version 	1.0.0
 */
add_action('admin_notices', '<%= nameSafe %>_admin_notice_settings_updated');

function <%= nameSafe %>_admin_notice_settings_updated() {

	$screen = get_current_screen();

	if ($screen->id === 'settings_page_<%= name %>'):

		if ( isset( $_POST['<%= nameSafe %>_form_submitted'] ) ):
?>

			<div class="notice notice-success is-dismissible">
				<p><?php _e('<%= nameFriendly %> settings successfully updated', '<%= name %>'); ?></p>
			</div>

<?php
		endif;
	endif;
}
?>