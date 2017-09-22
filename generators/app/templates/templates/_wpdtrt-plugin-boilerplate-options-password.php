<?php
/**
 * Form field partial for Admin Options page: Password
 *
 * This file contains PHP and HTML
 *
 * @since       0.5.0
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/templates
 */
?>

<tr>
	<th scope="row">
		<label for="<?php echo $name; ?>"><?php echo $label; ?>:</label>
	</th>
	<td>
		<input type="password" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="regular-text">
		<?php if ( isset($tip) ): ?>
		<p class="description"><?php echo $tip; ?></p>
		<?php endif; ?>
	</td>
</tr>
