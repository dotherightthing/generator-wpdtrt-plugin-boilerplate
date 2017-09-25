<?php
/**
 * Form field partial for Admin Options page: Checkbox
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/templates
 * @since 		0.6.0
 * @version 	1.0.0
 */
?>

<tr>
	<th scope="row">
		<label for="<?php echo $name; ?>"><?php echo $label; ?>:</label>
	</th>
	<td>
		<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="1" <?php checked( $value, '1', true ); ?>>
		<?php if ( isset($tip) ): ?>
		<p class="description"><?php echo $tip; ?></p>
		<?php endif; ?>
	</td>
</tr>
