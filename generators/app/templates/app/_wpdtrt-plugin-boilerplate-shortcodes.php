<?php
/**
 * Generate a shortcode, to embed the widget inside a content area.
 *
 * @example     [<%= nameSafe %> option="value"]
 * @example     do_shortcode( '[<%= nameSafe %> option="value"]' );
 * @see         https://generatewp.com/shortcodes/
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 * @since       0.1.0
 * @since       0.6.0 Renamed to ~shortcodes.php
 */

if ( !function_exists( '<%= nameSafe %>_shortcode' ) ) {

  /**
   * Add_shortcode
   *
   * @param       array $atts Optional shortcode attributes specified by the user
   * @param       string $content Content within the enclosing shortcode tags
   * @return      Shortcode
   *
   * @uses        ../../../../wp-includes/shortcodes.php
   * @see         https://codex.wordpress.org/Function_Reference/add_shortcode
   * @see         https://codex.wordpress.org/Shortcode_API#Enclosing_vs_self-closing_shortcodes
   * @see         http://php.net/manual/en/function.ob-start.php
   * @see         http://php.net/manual/en/function.ob-get-clean.php
   *
   * @since       0.1.0
   * @version     1.0.0
   */
  function <%= nameSafe %>_shortcode( $atts, $content = null ) {

    // post object to get info about the post in which the shortcode appears
    global $post;

    // predeclare wp variables
    $before_widget = null;
    $before_title = null;
    $title = null;
    $after_title = null;
    $after_widget = null;

    // predeclare shortcode option variables
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
        'enlargement' => '1'
      ),
      $atts,
      $shortcode
    );

    // only overwrite predeclared variables
    extract( $atts, EXTR_IF_EXISTS );

    // TODO: is this conversion redundant?
    if ( $enlargement === '1') {
      $enlargement = '1';
    }

    if ( $enlargement === 'no') {
      $enlargement = '0';
    }
    // end

    /**
     * Get plugin options
     */
    $<%= nameSafe %>_options = get_option( '<%= nameSafe %>' );

    // predeclare options variables
    $<%= nameSafe %>_datatype = null;
    $<%= nameSafe %>_data = null;

    // only overwrite predeclared variables
    extract( $<%= nameSafe %>_options, EXTR_IF_EXISTS );

    // configure mobile JS
    wp_localize_script(
      '<%= nameSafe %>_frontend_js',
      '<%= nameSafe %>_options',
      array(
        'datatype' => $<%= nameSafe %>_datatype,
        'data' => $<%= nameSafe %>_data
      )
    );

    // mimic WordPress template loading
    // to allow authors to override loaded templates
    $templates = new <%= nameFriendlySafe %>_Template_Loader;

    // pass options to get_template_part()
    $<%= nameSafe %>_options_all = array_merge( $atts, $<%= nameSafe %>_options );
    set_query_var( '<%= nameSafe %>_options_all', $<%= nameSafe %>_options_all );

    /**
     * ob_start — Turn on output buffering
     * This stores the HTML template in the buffer
     * so that it can be output into the content
     * rather than at the top of the page.
     */
    ob_start();

    // /template-parts/<%= name %>/content-blocks.php
    $templates->get_template_part( 'content', 'blocks' );

    /**
     * ob_get_clean — Get current buffer contents and delete current output buffer
     */
    $content = ob_get_clean();

    return $content;
  }

  add_shortcode( '<%= nameSafe %>', '<%= nameSafe %>_shortcode' );

}

?>
