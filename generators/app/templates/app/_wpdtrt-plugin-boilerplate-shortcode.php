<?php
/**
 * Generate a shortcode, to embed the widget inside a content area.
 *
 * This file contains PHP.
 *
 * @link       <%= pluginUrl %>
 * @link       https://generatewp.com/shortcodes/
 * @since      <%= version %>
 *
 * @example    [<%= nameSafe %>_blocks num_blocks="4" tooltip="on"]
 * @example    do_shortcode( '[<%= nameSafe %>_blocks num_blocks="4" tooltip="on"]' );
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
if ( !function_exists( '<%= nameSafe %>_blocks_shortcode' ) ) {

  add_shortcode( '<%= nameSafe %>_blocks', '<%= nameSafe %>_blocks_shortcode' );

  function <%= nameSafe %>_blocks_shortcode( $atts, $content = null ) {

    // post object to get info about the post in which the shortcode appears
    global $post;

    // prevent error when the front-end.php is used
    // by a shortcode which doesn't pass these variables
    $before_widget = $before_title = $title = $after_title = $after_widget = null;

    extract( shortcode_atts(
      array(
        'number' => '4',
        'enlargement' => 'yes'
      ),
      $atts,
      ''
    ) );

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
