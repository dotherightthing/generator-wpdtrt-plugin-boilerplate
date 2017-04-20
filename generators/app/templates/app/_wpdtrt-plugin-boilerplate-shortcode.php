<?php
/**
 * Generate a shortcode, to embed the widget inside a content area.
 *
 * This file contains PHP.
 *
 * @link       <%= pluginUrl %>
 * @link       https://generatewp.com/shortcodes/
 * @since      0.1.0
 *
 * @example    [<%= nameSafe %>_badges num_badges="4" tooltip="on"]
 * @example    do_shortcode( '[<%= nameSafe %>_badges num_badges="4" tooltip="on"]' );
 *
 * @package    <%= nameFriendlySafe %>
 * @subpackage <%= nameFriendlySafe %>/includes
 */

/**
 * add_shortcode
 * @param string $tag Required. Shortcode tag to be searched in post content.
 * @param callable $func Required. Hook to run when shortcode is found.
 * @link https://codex.wordpress.org/Function_Reference/add_shortcode
 */
if ( !function_exists( '<%= nameSafe %>_badges_shortcode' ) ) {

  add_shortcode( '<%= nameSafe %>_badges', '<%= nameSafe %>_badges_shortcode' );

  function <%= nameSafe %>_badges_shortcode( $atts, $content = null ) {

    // post object to get info about the post in which the shortcode appears
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

    $<%= nameSafe %>_options = get_option('<%= nameSafe %>');
    $<%= nameSafe %>_data = $<%= nameSafe %>_options['<%= nameSafe %>_data'];

    /**
     * ob_start — Turn on output buffering
     * This stores the HTML template in the buffer
     * so that it can be output into the content
     * rather than at the top of the page.
     * @link http://php.net/manual/en/function.ob-start.php
     */
    ob_start();

    require(<%= constantStub %>_PATH . 'views/public/partials/<%= name %>-front-end.php');

    /**
     * ob_get_clean — Get current buffer contents and delete current output buffer
     * @link http://php.net/manual/en/function.ob-get-clean.php
     */
    $content = ob_get_clean();

    return $content;
  }

}

?>
