<?php
/**
 * Displays data blocks
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/template-parts
 * @since     0.6.0
 * @version   1.0.0
 */

//global $<%= nameSafe %>_plugin;

// todo: is this query var seen by other plugins which also use this class?
// $options = get_query_var( $<%= nameSafe %>_plugin->get_prefix() . '_options_all' );
$options = get_query_var( 'wpdtrt_plugin_options' );

// plugin options
$datatype = null;
$data = null;

// shortcode options
$enlargement = null;
$number = null;

// overwrite plugin and enlargement options from array values
// @link http://kb.network.dan/php/wordpress/extract/
extract( $options, EXTR_IF_EXISTS );

// Internal WordPress arguments available to widgets
// This allows us to use the same template for shortcodes and front-end widgets
$before_widget = null;
$before_title = null;
$title = null;
$after_title = null;
$after_widget = null;

// Convert shortcode string attributes to integers
$max_length = (int)$number;
$count = 0;

 /**
  * filter_var
  * @link http://stackoverflow.com/a/15075609
  */
$has_enlargement = filter_var( $enlargement, FILTER_VALIDATE_BOOLEAN );

// WordPress widget options (not output with shortcode)
echo $before_widget;
echo $before_title . $title . $after_title;
?>

<div class="<%= name %>-items frontend">
  <ul>
  <?php
    foreach( $data as $key => $val ):

      // user - map block
      if ( isset( $data[$key]->{'address'} ) ):

        // TODO: convert to class methods format--()
        $lat = $data[$key]->{'address'}->{'geo'}->{'lat'};
        $lng = $data[$key]->{'address'}->{'geo'}->{'lng'};
        $latlng = $lat . ',' . $lng;
        $alt = esc_html__('Map showing the co-ordinates', '<%= name %>') . ' ' . $latlng;

      // coloured block
      else:

        $latlng = '';
        $alt = $data[$key]->{'title'};

      endif;

      if ( $has_enlargement ):
        $alt .= esc_html__('Click to view an enlargement', '<%= name %>');
      endif;
  ?>

      <li>
      <?php if ( $latlng !== '' ): ?>
        <?php if ( $has_enlargement ): ?>
          <!-- TODO: convert to class method format__() -->
          <a href="http://maps.googleapis.com/maps/api/staticmap?scale=2&amp;format=jpg&amp;maptype=satellite&amp;zoom=2&amp;markers=<?php echo $latlng; ?>&amp;key=<?php echo $google_maps_api_key; ?>&amp;size=600x600">
        <?php endif; ?>
            <img src="http://maps.googleapis.com/maps/api/staticmap?scale=2&amp;format=jpg&amp;maptype=satellite&amp;zoom=0&amp;markers=<?php echo $latlng; ?>&amp;key=<?php echo $google_maps_api_key; ?>&amp;size=150x150" alt="<?php echo $alt; ?>. ">
        <?php if ( $has_enlargement ): ?>
          </a>
        <?php endif; ?>
      <?php else: ?>
        <?php if ( $has_enlargement ): ?>
          <a href="<?php echo $data[$key]->{'url'}; ?>">
        <?php endif; ?>
          <img src="<?php echo $data[$key]->{'thumbnailUrl'}; ?>" alt="<?php echo $alt; ?>. ">
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
  // WordPress widget options (not output with shortcode)
  echo $after_widget;
?>
