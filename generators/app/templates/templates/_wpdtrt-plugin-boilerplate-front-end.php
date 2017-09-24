<?php
/**
 * Template partial for the public front-end
 *
 * This file contains PHP, and HTML.
 *
 * @link        <%= pluginUrl %>
 * @since       0.1.0
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/templates
 */
?>

<?php
  // output widget customisations (not output with shortcode)
  echo $before_widget;
  echo $before_title . $title . $after_title;
?>

<!-- TODO: load template blocks.php -->

<?php
  // output widget customisations (not output with shortcode)
  echo $after_widget;
?>
