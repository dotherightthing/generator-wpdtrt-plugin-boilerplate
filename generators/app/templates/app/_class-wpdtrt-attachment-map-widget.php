<?php
/**
 * Generate a widget, which is configured in WP Admin, and can be displayed in sidebars.
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 * @since       0.1.0
 */

if ( !function_exists( '<%= nameSafe %>_widgets_init' ) ) {

  add_action( 'widgets_init', '<%= nameSafe %>_widgets_init' );

  /**
   * Register a widget ready sidebar
   *
   * @example
   * // sidebar-test.php
   * if ( is_active_sidebar( 'sidebar-test' ) ) {
   *    dynamic_sidebar( 'sidebar-test' );
   * }
   *
   * // single.php
   * <?php get_sidebar('test'); ?>
   */
  function <%= nameSafe %>_widgets_init() {

    register_sidebar( array(
      'name'          => __( 'Test Sidebar', '<%= name %>' ),
      'id'            => 'sidebar-test',
      'description'   => __( 'Add widgets here to appear in the Test sidebar.', '<%= name %>' ),
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    ));
  }

}

if ( !function_exists( '<%= nameSafe %>_register_widget' ) ) {

  add_action( 'widgets_init', '<%= nameSafe %>_register_widget' );

  /**
   * Register the widget
   * Note: widget_init fires before init, unless init has a priority of 0
   *
   * @uses        ../../../../wp-includes/widgets.php
   * @see         https://codex.wordpress.org/Function_Reference/register_widget#Example
   * @see         https://wp-mix.com/wordpress-widget_init-not-working/
   * @see         https://codex.wordpress.org/Plugin_API/Action_Reference
   *
   * @since       0.1.0
   * @version     1.0.0
   */
  function <%= nameSafe %>_register_widget() {

    // pass object reference between classes via global
    // because the object does not exist until the WordPress init action has fired
    global $<%= nameSafe %>_plugin;

    register_widget( '<%= nameFriendlySafe %>_Widget' );
  }
}

if ( !class_exists( '<%= nameFriendlySafe %>_Widget' ) ) {

  /**
   * Extend WP_Widget
   *    This class must be extended for each widget, and WP_Widget::widget() must be overridden.
   *    Class names should use capitalized words separated by underscores. Any acronyms should be all upper case.
   *
   * @uses        ../../../../wp-includes/class-wp-widget.php:
   * @see         https://developer.wordpress.org/reference/classes/wp_widget/
   * @see         https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/#naming-conventions
   *
   * @since       0.1.0
   * @version     1.0.0
   */

  class <%= nameFriendlySafe %>_Widget extends WP_Widget {

    function __construct() {

      global $<%= nameSafe %>_plugin;

      // Store a reference to the partner plugin object
      // which stores global plugin options and shortcode/widget options
      $this->set_wpdtrt_plugin_object( $<%= nameSafe %>_plugin );

      // Instantiate the parent object
      parent::__construct( false, '<%= nameFriendly %> Widget' );
    }

    /**
     * Set parent plugin, which contains shortcode/widget options
     * This is a global which is passed to the function which instantiates this object.
     * This is necessary because the object does not exist until the WordPress init action has fired.
     *
     * @todo Can this be improved? Setting a high priority (of 0) on the init action
     *  does not make the object available to the widget_init action
     *  which should run afterwards.
     *  Can the reference be passed in a better way?
     *
     * @since 1.0.0
     *
     * @param object
     */
    protected function set_wpdtrt_plugin_object( $wpdtrt_plugin_object ) {
      $this->wpdtrt_plugin_object = $wpdtrt_plugin_object;
    }

    /**
     * Get parent plugin, which contains shortcode/widget options
     *
     * @since 1.0.0
     *
     * @return object
     */
    public function get_wpdtrt_plugin_object() {
      return $this->wpdtrt_plugin_object;
    }

    /**
     * Echoes the widget content to the front-end
     * @todo when $enlargement is ommitted,
     *  the value is overwritten with the default
     *  which results in a value of 1
     */
    function widget( $args, $instance ) {

      /**
       * Get the unique ID
       * @link https://kylebenk.com/how-to-wordpress-widget-id/
       */
      // $instance_id = $this->id;

      // Predeclare WP widget variables
      $before_widget = null;
      $before_title = null;
      $title = null;
      $after_title = null;
      $after_widget = null;

      // Load existing options
      $wpdtrt_plugin_object = $this->get_wpdtrt_plugin_object();
      $options = $wpdtrt_plugin_object->get_options(); // plugin and shortcode/widget options

      // widget options
      $widget_instance_options = $instance;

      /**
       * apply_filters( $tag, $value );
       * Apply the 'widget_title' filter to get the title of the instance.
       * Display the title of this instance, which the user can optionally customise
       */
      $title = apply_filters( 'widget_title', $widget_instance_options['title'] );

      // pass options to get_template_part()
      $options_all = array_merge( $options, $widget_instance_options );

      //set_query_var( $this->get_prefix() . '_options_all', $options_all );
      set_query_var( 'wpdtrt_plugin_options', $options_all );

      /**
       * ob_start — Turn on output buffering
       * This stores the HTML template in the buffer
       * so that it can be output into the content
       * rather than at the top of the page.
       */
      ob_start();

      // mimic WordPress template loading
      // to allow authors to override loaded templates
      $templates = new <%= nameFriendlySafe %>_Template_Loader;

      // /template-parts/wpdtrt-plugin-name/content-blocks.php
      $templates->get_template_part( 'content', 'blocks' );

      /**
       * ob_get_clean — Get current buffer contents and delete current output buffer
       */
      $content = ob_get_clean();

      // echo not return
      echo $content;
    }

    /**
     * Updates a particular instance of a widget, by replacing the old instance with data from the new instance
     */
    function update( $new_instance, $old_instance ) {
      // Save user input (widget options)

      $wpdtrt_plugin_object = $this->get_wpdtrt_plugin_object();
      $instance = $old_instance;
      $shortcode_option_defaults = $wpdtrt_plugin_object->get_shortcode_option_defaults();

      /**
       * strip_tags — Strip HTML and PHP tags from a string
       * @example string strip_tags ( string $str [, string $allowable_tags ] )
       * @link http://php.net/manual/en/function.strip-tags.php
       */
      if ( isset( $new_instance['title'] ) ) {
        $instance['title'] = strip_tags( $new_instance['title'] );
      }

      foreach( $shortcode_option_defaults as $key=>$value ) {

        // todo: does this check prevent empty values from being saved?
        if ( isset( $new_instance[ $key ] ) ) {
          $instance[ $key ] = strip_tags( $new_instance[ $key ] );
        }
      }

      return $instance;
    }

    /**
     * Outputs the settings update form in wp-admin.
     */
    function form( $instance ) {

      $wpdtrt_plugin_object = $this->get_wpdtrt_plugin_object(); // is this targetting the parent/base class rather than the instatiated object?
      $shortcode_option_defaults = $wpdtrt_plugin_object->get_shortcode_option_defaults();

      /**
        * Escape HTML attributes to sanitize the data.
        * @example esc_attr( string $text )
        * @link https://developer.wordpress.org/reference/functions/esc_attr/
        */
      if ( isset( $instance['title'] ) ) {
        $title = esc_attr( $instance['title'] );
      }
      else {
        $title = null;
      }

      foreach( $shortcode_option_defaults as $key=>$value ) {

        if ( isset( $instance[ $key ] ) ) {
          // $enlargement = $instance[ 'enlargement' ];
          ${$key} = esc_attr( $instance[ $key ] );
        }
        else {
          ${$key} = null;
        }
      }

      $options = $wpdtrt_plugin_object->get_options();
      $data = $options['data'];

      /**
       * Load the HTML template
       * This function's variables will be available to this template.
       */
      require(<%= constantStub %>_PATH . 'templates/widget-admin.php');
    }
  }

}

?>
