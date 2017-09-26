<?php
/**
 * Displays data blocks
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/template-parts
 * @since     0.6.0
 * @version   1.0.0
 */

$options = get_query_var( '<%= nameSafe %>_options_all' );

if ( is_array( $options ) ) {

  /**
   * predeclare the expected variables
   * @see http://kb.dotherightthing.dan/php/wordpress/extract/
   */
    $number = null;
    $enlargement = null;
    $<%= nameSafe %>_datatype = null;
    $<%= nameSafe %>_data = null;

  /**
   * only overwrite the predeclared variables
   * @see http://kb.dotherightthing.dan/php/wordpress/extract/
   */
  extract($options, EXTR_IF_EXISTS);
}

/**
 * cast the $number string to a number
 * this is required because we are doing a === comparison:
 * 1 == '1' => true
 * 1 === '1' => false
 */
$before_widget = null;
$before_title = null;
$title = null;
$after_title = null;
$after_widget = null;

$max_length = (int)$number;
$count = 0;
$apikey = 'AIzaSyAyMI7z2mnFYdONaVV78weOmB0U2LThZMo'; // TODO add field

 /**
  * filter_var
  * @link http://stackoverflow.com/a/15075609
  */
$has_enlargement = filter_var( $enlargement, FILTER_VALIDATE_BOOLEAN );

// output widget customisations (not output with shortcode)
echo $before_widget;
echo $before_title . $title . $after_title;
?>

<div class="<%= name %>-items frontend">
  <ul>
  <?php
    foreach( $<%= nameSafe %>_data as $key => $val ):

      // user - map block
      if ( isset( $<%= nameSafe %>_data[$key]->{'address'} ) ):

        $lat = $<%= nameSafe %>_data[$key]->{'address'}->{'geo'}->{'lat'};
        $lng = $<%= nameSafe %>_data[$key]->{'address'}->{'geo'}->{'lng'};
        $latlng = $lat . ',' . $lng;
        $alt = esc_html__('Map showing the co-ordinates', '<%= name %>') . ' ' . $latlng;

      // coloured block
      else:

        $latlng = '';
        $alt = $<%= nameSafe %>_data[$key]->{'title'};

      endif;

      if ( $has_enlargement ):
        $alt .= esc_html__('Click to view an enlargement', '<%= name %>');
      endif;
  ?>

      <li>
      <?php if ( $latlng !== '' ): ?>
        <?php if ( $has_enlargement ): ?>
          <a href="http://maps.googleapis.com/maps/api/staticmap?scale=2&amp;format=jpg&amp;maptype=satellite&amp;zoom=2&amp;markers=<?php echo $latlng; ?>&amp;key=<?php echo $apikey; ?>&amp;size=600x600">
        <?php endif; ?>
            <img src="http://maps.googleapis.com/maps/api/staticmap?scale=2&amp;format=jpg&amp;maptype=satellite&amp;zoom=0&amp;markers=<?php echo $latlng; ?>&amp;key=<?php echo $apikey; ?>&amp;size=150x150" alt="<?php echo $alt; ?>. ">
        <?php if ( $has_enlargement ): ?>
          </a>
        <?php endif; ?>
      <?php else: ?>
        <?php if ( $has_enlargement ): ?>
          <a href="<?php echo $<%= nameSafe %>_data[$key]->{'url'}; ?>">
        <?php endif; ?>
          <img src="<?php echo $<%= nameSafe %>_data[$key]->{'thumbnailUrl'}; ?>" alt="<?php echo $alt; ?>. ">
        <?php if ( $has_enlargement ): ?>
          </a>
        <?php endif; ?>
      <?php endif; ?>
      </li>

  <?php
      $count++;

      // when we reach the end of the demo sample, stop looping
      if ($count === $max_length) {
        break;
      }

    endforeach;
  ?>
  </ul>
</div>

<?php
  // output widget customisations (not output with shortcode)
  echo $after_widget;
?>
