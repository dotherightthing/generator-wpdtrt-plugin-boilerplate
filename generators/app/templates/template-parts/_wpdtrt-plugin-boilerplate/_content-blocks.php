<?php
/**
 * Displays data blocks
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/template-parts
 * @since     0.6.0
 * @version   1.0.0
 */

global $<%= nameSafe %>_plugin;

// todo: is this query var seen by other plugins which also use this class?
// $options = get_query_var( $<%= nameSafe %>_plugin->get_prefix() . '_options_all' );
$options = get_query_var( 'wpdtrt_plugin_options' );

// plugin options
$datatype = null;
$data = null;
$google_maps_api_key = null;

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

      $object =           $data[$key];
      $latlng =           $<%= nameSafe %>_plugin->get_api_latlng( $object );
      $thetitle =         $<%= nameSafe %>_plugin->get_api_title( $object );
      $enlargement_url =  $<%= nameSafe %>_plugin->get_api_thumbnail_url( $object, true, $google_maps_api_key );
      $thumbnail_url =    $<%= nameSafe %>_plugin->get_api_thumbnail_url( $object, false, $google_maps_api_key );
      $alt =              $latlng ? ( esc_html__('Map showing the co-ordinates', '<%= name %>') . ' ' . $latlng ) : $thetitle;
  ?>
      <li>
        <?php if ( $has_enlargement ): ?>
          <a href="<?php echo $enlargement_url; ?>">
            <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $alt; ?>. ">
          </a>
        <?php else: ?>
            <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $alt; ?>. ">
        <?php endif; ?>
      </li>

  <?php
      $count++;

      // when we reach the end of the demo sample, stop looping
      if ($count === $max_length):
        break;
      endif;

    endforeach;
  ?>
  </ul>
</div>

<?php
  // WordPress widget options (not output with shortcode)
  echo $after_widget;
?>
