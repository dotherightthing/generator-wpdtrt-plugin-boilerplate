<?php
/**
 * Generate a shortcode, to embed the widget inside a content area.
 *
 * This file contains PHP.
 *
 * @link        <%= pluginUrl %>
 * @link        https://generatewp.com/shortcodes/
 * @since       0.1.0
 *
 * @example     [<%= nameSafe %> number="4" enlargement="yes"]
 * @example     do_shortcode( '[<%= nameSafe %> number="4" enlargement="yes"]' );
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 */

if ( !function_exists( '<%= nameSafe %>_shortcode' ) ) {

  /**
   * add_shortcode
   * @param       string $tag
   *    Shortcode tag to be searched in post content.
   * @param       callable $func
   *    Hook to run when shortcode is found.
   *
   * @since       0.1.0
   * @uses        ../../../../wp-includes/shortcodes.php
   * @see         https://codex.wordpress.org/Function_Reference/add_shortcode
   * @see         http://php.net/manual/en/function.ob-start.php
   * @see         http://php.net/manual/en/function.ob-get-clean.php
   */
  function <%= nameSafe %>_shortcode( $atts, $content = null ) {

    // post object to get info about the post in which the shortcode appears
    global $post;

    // predeclare variables
    $before_widget = null;
    $before_title = null;
    $title = null;
    $after_title = null;
    $after_widget = null;
    $number = null;
    $enlargement = null;
    $shortcode = '<%= nameSafe %>_shortcode';

    /**
     * Combine user attributes with known attributes and fill in defaults when needed.
     * @see https://developer.wordpress.org/reference/functions/shortcode_atts/
     */
    $atts = shortcode_atts(
      array(
        'number' => '4',
        'enlargement' => 'yes'
      ),
      $atts,
      $shortcode
    );

    // only overwrite predeclared variables
    extract( $atts, EXTR_IF_EXISTS );

    if ( $enlargement === 'yes') {
      $enlargement = '1';
    }

    if ( $enlargement === 'no') {
      $enlargement = '0';
    }

    $<%= nameSafe %>_options = get_option('<%= nameSafe %>');
    $<%= nameSafe %>_data = $<%= nameSafe %>_options['<%= nameSafe %>_data'];

    /**
     * ob_start — Turn on output buffering
     * This stores the HTML template in the buffer
     * so that it can be output into the content
     * rather than at the top of the page.
     */
    ob_start();

    require(<%= constantStub %>_PATH . 'templates/<%= name %>-front-end.php');

    /**
     * ob_get_clean — Get current buffer contents and delete current output buffer
     */
    $content = ob_get_clean();

    return $content;
  }

  add_shortcode( '<%= nameSafe %>', '<%= nameSafe %>_shortcode' );

}

?>
