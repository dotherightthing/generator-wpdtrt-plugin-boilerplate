<?php
/**
 * Functions which generate HTML strings
 * These are separated out for testing purposes.
 *
 * This file contains PHP.
 *
 * @link       <%= pluginUrl %>
 * @since      0.1.0
 *
 * @package    <%= nameFriendlySafe %>
 * @subpackage <%= nameFriendlySafe %>/includes
 */

/**
 * <%= nameSafe %>_html_image
 * Generate the HTML for a block image
 * @param string $key Required. The key of the corresponding JSON object.
 * @param boolean $has_enlargement Optional.
 * @return string. An HTML image element, optionally wrapped in a hyperlink.
 */
if ( !function_exists( '<%= nameSafe %>_html_image' ) ) {

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
        $str .= '&zoom=0';
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

    $str .= '">';

    if ( $has_enlargement ) {
      $str .= '</a>';
    }

    return $str;
  }
}

/**
 * <%= nameSafe %>_html_latlng
 * Get a block's map coordinates
 * @param string $key Required. The key of the JSON object.
 * @return string. "lat,lng" | ""
 */
if ( !function_exists( '<%= nameSafe %>_html_latlng' ) ) {

  //$<%= nameSafe %>_data[$key]->{'address'}

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

/**
 * <%= nameSafe %>_html_title
 * Get a block's title
 * @param string $key Required. The key of the JSON object.
 * @param boolean $has_enlargement Optional.
 * @return string. "The title"
 */
if ( !function_exists( '<%= nameSafe %>_html_title' ) ) {

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


?>
