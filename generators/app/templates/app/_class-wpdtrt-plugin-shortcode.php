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

if ( !class_exists( 'WPDTRT_Plugin_Shortcode' ) ) {

  /**
   * WPDTRT_Plugin_Shortcode
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
  class WPDTRT_Plugin_Shortcode {

    /**
     * Prefix for names.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $prefix = 'your_plugin';

    /**
     * Shortcode name
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $shortcode_name = 'your_shortcode_name';

    /**
     * Prefix for constants.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $constant_stub = 'YOUR_PLUGIN';

    // post object to get info about the post in which the shortcode appears
    // TODO: seems to be redundant
    //global $post;

    /**
     * Predeclare WP variables
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $before_widget = null;
    public $before_title = null;
    public $title = null;
    public $after_title = null;
    public $after_widget = null;

    // predeclare shortcode option variables
    public $number = null;
    public $enlargement = null;

    /**
     * Shortcode name
     *
     * e.g. 'your_plugin' or 'your_plugin_action'
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $shortcode = '<%= nameSafe %>_shortcode';

    /**
     * Default options used by the shortcode
     *
     * @since 1.0.0
     */
    public $shortcode_option_defaults = array(
        'number' => '4',
        'enlargement' => '1' // 1 || 0
    );

    /**
     * Default options used by the plugin
     *
     * @since 1.0.0
     */
    public $plugin_option_defaults = array(
        'datatype' => null,
        'data' => null
    );

    /**
     * Get plugin options
     *
     * @since 1.0.0
     *
     * @return array
     */
    private function get_plugin_options() {

      $options = get_option( $this->prefix );

      return $options;

      // predeclare options variables
      // TODO $this->plugin_option_defaults
      //$<%= nameSafe %>_datatype = null;
      //$<%= nameSafe %>_data = null;

      // only overwrite predeclared variables
      //extract( $<%= nameSafe %>_options, EXTR_IF_EXISTS );
    }

    /**
     * Generate a JavaScript object which the front-end can query
     *
     * @since 1.0.0
     */
    public function render_plugin_options_as_js() {

      // TODO
      // array = foreach options as option, 'option' => option

      // configure mobile JS
      wp_localize_script(
        $this->prefix . '_frontend_js',
        $this->prefix . '_options',
        //TODO use: $this->plugin_option_defaults
        //TODO: use $this->prefix
        array(
          'datatype' => $<%= nameSafe %>_datatype,
          'data' => $<%= nameSafe %>_data
        )
      );
    }

    /**
     * Render a shortcode
     *
     * @since 1.0.0
     *
     * @param array $atts Shortcode options
     * @param string $content Content between shortcode opening and closing tags
     *
     * @return string
     */
    private function render_shortcode( $atts, $content = null ) {

      /**
       * Combine user attributes with known attributes and fill in defaults when needed.
       * @see https://developer.wordpress.org/reference/functions/shortcode_atts/
       */
      $shortcode_options = shortcode_atts(
        $this->shortcode_option_defaults,
        $atts,
        $this->prefix . '_' . $this->shortcode_name
      );

      // only overwrite predeclared variables
      //extract( $atts, EXTR_IF_EXISTS );

      // mimic WordPress template loading
      // to allow authors to override loaded templates
      $templates = new WPDTRT_Plugin_Template_Loader;

      // pass options to get_template_part()
      $options_all = array_merge( $shortcode_options, $this->plugin_option_defaults );
      set_query_var( $this->prefix . '_options_all', $options_all );

      $this->render_plugin_options_as_js();

      /**
       * ob_start — Turn on output buffering
       * This stores the HTML template in the buffer
       * so that it can be output into the content
       * rather than at the top of the page.
       */
      ob_start();

      // /template-parts/<%= name %>/content-blocks.php
      // TODO
      $templates->get_template_part( 'content', 'blocks' );

      /**
       * ob_get_clean — Get current buffer contents and delete current output buffer
       */
      $content = ob_get_clean();

      return $content;
    }

    /**
     * Register a shortcode with WordPress
     *
     * @since 1.0.0
     */
    public function register_shortcode() {

      add_shortcode( $this->prefix . '_' . $this->shortcode_name, $this->render_shortcode );

    }

  }

}

?>
