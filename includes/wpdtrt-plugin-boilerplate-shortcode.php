<?php
/**
 * Generate a shortcode, to embed the widget inside a content area.
 *
 * This file contains PHP.
 *
 * @link       http://www.dotherightthing.co.nz/
 * @link       https://generatewp.com/shortcodes/
 * @since      1.0.0
 *
 * @example    [dtrt_plugin_boilerplate arg1="value"]
 * @example    do_shortcode( '[ddtrt_plugin_boilerplate arg1="value"]' );
 *
 * @package    DTRT_Plugin_Boilerplate
 * @subpackage DTRT_Plugin_Boilerplate/includes
 */

/**
 * add_shortcode
 * @param string $tag Required. Shortcode tag to be searched in post content.
 * @param callable $func Required. Hook to run when shortcode is found.
 * @link https://codex.wordpress.org/Function_Reference/add_shortcode
 */
if ( !function_exists( 'wpdtrt_badges_shortcode' ) ) {

  add_shortcode( 'wpdtrt_badges', 'wpdtrt_badges_shortcode' );

  function wpdtrt_badges_shortcode( $atts, $content = null ) {

    // post object to get info about the post in qwhich the shortcode appears
    global $post;

    extract( shortcode_atts(
      array(
        'num_badges' => '4',
        'tooltip' => 'on'
      ),
      $atts,
      ''
    ) );

    if ( $tooltip === 'on') {
      $tooltip = '1';
    }

    if ( $tooltip === 'off') {
      $tooltip = '0';
    }

    $display_tooltips = $tooltip;

    $wpdtrt_plugin_boilerplate_options = get_option('wpdtrt_plugin_boilerplate');
    $wpdtrt_data = $wpdtrt_plugin_boilerplate_options['wpdtrt_data'];

    /**
     * ob_start — Turn on output buffering
     * This stores the HTML template in the buffer
     * so that it can be output into the content
     * rather than at the top of the page.
     * @link http://php.net/manual/en/function.ob-start.php
     */
    ob_start();

    require_once(WPDTRT_PLUGIN_BOILERPLATE_PATH . 'public/partials/wpdtrt-plugin-boilerplate-front-end.php');

    /**
     * ob_get_clean — Get current buffer contents and delete current output buffer
     * @link http://php.net/manual/en/function.ob-get-clean.php
     */
    $content = ob_get_clean();

    return $content;
  }

}

?>
