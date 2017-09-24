<?php
/**
 * Displays blocks
 *
 * @since       0.1.0
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/templates-parts
 */

$options = get_query_var( 'wpdtrt_responsive_nav_options_all' );

if ( is_array( $options ) ) {

  /**
   * predeclare the expected variables
   * @see http://kb.dotherightthing.dan/php/wordpress/extract/
   */
    $number = null;
    $enlargement = null;
    $wpdtrt_responsive_nav_datatype = null;
    $wpdtrt_responsive_nav_data = null;

  /**
   * only overwrite the predeclared variables
   * @see http://kb.dotherightthing.dan/php/wordpress/extract/
   */
  extract($options, EXTR_IF_EXISTS);
}

?>

<?php
  // output widget customisations (not output with shortcode)
  echo $before_widget;
  echo $before_title . $title . $after_title;
?>

<div class="<%= name %>-items frontend">
  <ul>

  <?php
  /**
   * cast the $number string to a number
   * this is required because we are doing a === comparison:
   * 1 == '1' => true
   * 1 === '1' => false
   */
    $max_length = (int)$number;
    $count = 0;
    $display_count = 1;

   /**
     * filter_var
     * @link http://stackoverflow.com/a/15075609
     */
    $has_enlargement = filter_var( $enlargement, FILTER_VALIDATE_BOOLEAN );

    foreach( $<%= nameSafe %>_data as $key => $val ) {

      echo "<li>";

      // TODO: merge in <%= nameSafe %>_html_image
      echo <%= nameSafe %>_html_image( $key, $has_enlargement );

      echo "</li>\r\n";

      $count++;
      $display_count++;

      // when we reach the end of the demo sample, stop looping
      if ($count === $max_length) {
        break;
      }
    }
    // end foreach
  ?>
  </ul>
</div>

<?php
  // output widget customisations (not output with shortcode)
  echo $after_widget;
?>

