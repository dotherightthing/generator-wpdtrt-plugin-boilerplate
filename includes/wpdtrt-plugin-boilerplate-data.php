<?php
/**
 * Data requests
 *
 * This file contains PHP.
 *
 * @link       http://www.dotherightthing.co.nz/
 * @since      1.0.0
 *
 * @package    DTRT_Plugin_Boilerplate
 * @subpackage DTRT_Plugin_Boilerplate/includes
 */

/**
 * wpdtrt_plugin_boilerplate_data_get
 * @param string $wpdtrt_username Required. The account username.
 * @return object $wpdtrt_data. The body of the JSON.
 */
function wpdtrt_plugin_boilerplate_data_get( $wpdtrt_username ) {
  $json_feed_url = 'http://teamtreehouse.com/' . $wpdtrt_username . '.json';
  $args = array(
    'timeout' => 120 // wait 120 seconds for the request to complete
  );

  /**
   * wp_remote_get( string $url, array $args = array() )
   * Retrieve the raw response from the HTTP request using the GET method.
   * @link https://developer.wordpress.org/reference/functions/wp_remote_get/
   */
  $json_feed = wp_remote_get(
    $json_feed_url,
    $args
  );

  /**
   * Return the body, not the header
   * Note: There is an optional boolean argument, which returns an associative array if TRUE
   */
  $wpdtrt_data = json_decode( $json_feed['body'] );

  return $wpdtrt_data;
}

/**
 * wpdtrt_plugin_boilerplate_data_refresh
 * a custom hook that can be used by JavaScript AJAX calls
 * wp_ajax_ is a common prefix
 */
add_action('wp_ajax_wpdtrt_plugin_boilerplate_data_refresh', 'wpdtrt_plugin_boilerplate_data_refresh');

function wpdtrt_plugin_boilerplate_data_refresh() {

  $options = get_option('wpdtrt_plugin_boilerplate');
  $last_updated = $options['last_updated'];

  $current_time = time();
  $update_difference = $current_time - $last_updated;
  $one_day = (24 * 60 * 60);

  if ( $update_difference > $one_day ) {

    $wpdtrt_username = $options['wpdtrt_username'];

    $options['wpdtrt_data'] = wpdtrt_plugin_boilerplate_data_get( $wpdtrt_username );

    // inspecting the database will allow us to check
    // whether the profile is being updated
    $options['last_updated'] = time();

    update_option('wpdtrt_plugin_boilerplate', $options);
  }

  // Let the Ajax know when the entire function has completed
  die();
}

/**
 * Add a JavaScript file to wp head
 * Displays the AJAX enabling JS on the front-end of the site.
 * to permit the Ajax call when an Ajax command is submitted.
 * passing it through the Admin Ajax page, and then onto our refresh_data function
 * @todo Could we use: wp_localize_script( 'wpdtrt_plugin_boilerplate_css_frontend_and_js', 'ajaxurl', admin_url('admin-ajax.php') );
 */
add_action( 'wp_head', 'wpdtrt_plugin_boilerplate_enable_frontend_ajax' );

function wpdtrt_plugin_boilerplate_enable_frontend_ajax() {
?>
  <script>
    var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
  </script>
<?php
}

?>
