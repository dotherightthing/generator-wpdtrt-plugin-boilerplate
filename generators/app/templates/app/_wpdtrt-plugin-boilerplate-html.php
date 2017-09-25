<?php
/**
 * Functions which generate HTML strings
 *
 * @todo        Convert to shortcodes/templates
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 * @since       0.1.0
 */

if ( !function_exists( '<%= nameSafe %>_html_image' ) ) {

  /**
   * Generate the HTML for a (linked) image
   *
   * @param       string $key The key of the corresponding JSON object
   * @param       boolean $has_enlargement (optional) Whether the image should link to an enlargement
   * @return      string <a href="..."><img src="..." alt="..."></a>
   *
   * @since       0.1.0
   * @version     1.0.0
   */
  function <%= nameSafe %>_html_image( $key, $has_enlargement = 0 ) {

    // if options have not been stored, exit
    $<%= nameSafe %>_options = get_option('<%= nameSafe %>');

    if ( $<%= nameSafe %>_options === '' ) {
      return '';
    }

    // the data set
    $<%= nameSafe %>_data = $<%= nameSafe %>_options['<%= nameSafe %>_data'];

    $str = '';

    if ( $has_enlargement ) {

      if ( isset( $<%= nameSafe %>_data[$key]->{'address'} ) ) {

        $str .= '<a href="';
        $str .= 'http://maps.googleapis.com/maps/api/staticmap';
        $str .= '?scale=2';
        $str .= '&format=jpg';
        $str .= '&maptype=satellite';
        $str .= '&zoom=2';
        $str .= '&markers=' . <%= nameSafe %>_html_latlng( $key );
        $str .= '&key=AIzaSyAyMI7z2mnFYdONaVV78weOmB0U2LThZMo';
        $str .= '&size=600x600';
        $str .= '">';

      }
      else {

        $str .= '<a href="';
        $str .= $<%= nameSafe %>_data[$key]->{'url'};
        $str .= '">';

      }
    }

    $str .= '<img src="';

    // user - map block
    if ( isset( $<%= nameSafe %>_data[$key]->{'address'} ) ) {

      $str .= 'http://maps.googleapis.com/maps/api/staticmap';
      $str .= '?scale=2';
      $str .= '&format=jpg';
      $str .= '&maptype=satellite';
      $str .= '&zoom=0';
      $str .= '&markers=' . <%= nameSafe %>_html_latlng( $key );
      $str .= '&key=AIzaSyAyMI7z2mnFYdONaVV78weOmB0U2LThZMo';
      $str .= '&size=150x150';

    }
    else {

      $str .= $<%= nameSafe %>_data[$key]->{'thumbnailUrl'};

    }

    $str .='" alt="';

    $str .= <%= nameSafe %>_html_title( $key, $has_enlargement );

    $str .= '. ">';

    if ( $has_enlargement ) {
      $str .= '</a>';
    }

    return $str;
  }
}

if ( !function_exists( '<%= nameSafe %>_html_latlng' ) ) {

  /**
   * Get the coordinates of a map location
   *
   * @param       string $key The key of the JSON object.
   * @return      string "lat,lng" | ""
   *
   * @since       0.1.0
   * @version     1.0.0
   */
  function <%= nameSafe %>_html_latlng( $key ) {

    // if options have not been stored, exit
    $<%= nameSafe %>_options = get_option('<%= nameSafe %>');

    if ( $<%= nameSafe %>_options === '' ) {
      return '';
    }

    // the data set
    $<%= nameSafe %>_data = $<%= nameSafe %>_options['<%= nameSafe %>_data'];

    // user - map block
    if ( isset( $<%= nameSafe %>_data[$key]->{'address'} ) ) :

      $lat = $<%= nameSafe %>_data[$key]->{'address'}->{'geo'}->{'lat'};
      $lng = $<%= nameSafe %>_data[$key]->{'address'}->{'geo'}->{'lng'};

      $str = $lat . ',' . $lng;

    else:

      $str = '';

    endif;

    return $str;
  }
}

if ( !function_exists( '<%= nameSafe %>_html_title' ) ) {

  /**
   * Generate an Alt attribute
   *
   * @param       string $key The key of the JSON object.
   * @param       boolean $has_enlargement (optional) Whether the image should link to an enlargement
   * @return      string The title
   *
   * @version     1.0.0
   * @since       0.1.0
   */
  function <%= nameSafe %>_html_title( $key, $has_enlargement = 0 ) {

    // if options have not been stored, exit
    $<%= nameSafe %>_options = get_option('<%= nameSafe %>');

    if ( $<%= nameSafe %>_options === '' ) {
      return '';
    }

    // the data set
    $<%= nameSafe %>_data = $<%= nameSafe %>_options['<%= nameSafe %>_data'];

    // user - map block
    if ( isset( $<%= nameSafe %>_data[$key]->{'address'} ) ) {

      $str = 'Map showing the co-ordinates ' . <%= nameSafe %>_html_latlng( $key );

    // photo - coloured block
    } else {

      $str = $<%= nameSafe %>_data[$key]->{'title'};

    }

    if ( $has_enlargement ) {
      $str .= ". Click to view an enlargement";
    }

    return $str;
  }
}

if ( !function_exists( '<%= nameSafe %>_html_date' ) ) {

  /**
   * Generate the HTML for the last modified date
   *
   * @return string <p class="wpdtrt_soundcloud_pages_date">Last updated 23rd April 2017</p>
   *
   * @since 0.1.0
   * @version 1.0.0
   */
  function <%= nameSafe %>_html_date() {

    // if options have not been stored, exit
    $<%= nameSafe %>_options = get_option('<%= nameSafe %>');

    if ( $<%= nameSafe %>_options === '' ) {
      return '';
    }

    // the data set
    $last_updated = $<%= nameSafe %>_options['last_updated'];

    // use the date format set by the user
    $wp_date_format = get_option('date_format');
    $wp_time_format = get_option('time_format');

    $str = '';
    $str .= date( $wp_time_format, $last_updated );
    $str .= ', ';
    $str .= date( $wp_date_format, $last_updated );

    return $str;
  }
}

?>
