<?php
/**
 * Rewrite Rules
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
 * Add rewrite rules in case another plugin flushes rules
 */
add_action('init', '<%= nameSafe %>_rewrite_rules');

/**
 * Add custom rewrite rules
 * WordPress allows theme and plugin developers to programmatically specify new, custom rewrite rules.
 *
 * @see http://clivern.com/how-to-add-custom-rewrite-rules-in-wordpress/
 * @see https://www.pmg.com/blog/a-mostly-complete-guide-to-the-wordpress-rewrite-api/
 * @see https://www.addedbytes.com/articles/for-beginners/url-rewriting-for-beginners/
 * @see http://codex.wordpress.org/Rewrite_API
 */
function <%= nameSafe %>_rewrite_rules() {

    global $wp_rewrite;

    // ...
}

?>