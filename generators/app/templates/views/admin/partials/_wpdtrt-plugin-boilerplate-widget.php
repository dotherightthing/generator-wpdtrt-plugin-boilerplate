<?php
/**
 * Template partial for Admin Widget
 * WP Admin > Appearance > Widgets > <%= nameFriendly %>
 *
 * This file contains PHP, and HTML fields.
 *
 * @link       <%= pluginUrl %>
 * @link       /wp-admin/admin.php?page=WordPress_Admin_Style#twocolumnlayout2
 * @since      0.1.0
 *
 * @package    <%= nameFriendlySafe %>
 * @subpackage <%= nameFriendlySafe %>/admin/partials
 */
?>

<p>
  <label>Title</label>
  <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
  Total Badges
  <?php echo count($<%= nameSafe %>_data->{'badges'}); ?>
</p>
<p>
  <label>How many of your most recent badges would you you like to display?</label>
  <input size="4" name="<?php echo $this->get_field_name('num_badges'); ?>" type="text" value="<?php echo $num_badges; ?>" />
</p>

<?php
/**
 * Checked
 * For use in checkbox and radio button form fields.
 * Compares two given values (for example, a saved option vs. one chosen in a form)
 * and, if the values are the same, adds the checked attribute to the current radio button or checkbox.
 * @example <?php checked( $checked, $current, $echo ); ?>
 * @link https://codex.wordpress.org/Function_Reference/checked
 */
?>
<p>
  <label>Display tooltips?</label>
  <input type="checkbox" name="<?php echo $this->get_field_name('display_tooltips'); ?>" value="1" <?php checked( $display_tooltips, 1 ); ?> />
</p>
