<?php
/**
 * Functionality for the WP Admin Plugin Options page
 *    WP Admin > Settings > <%= nameFriendly %>
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/app
 * @since       0.1.0
 */

if ( !function_exists( '<%= nameSafe %>_menu' ) ) {


  /**
   * Display a link to the options page in the admin menu
   *
   * @uses        ../../../../wp-admin/includes/plugin.php
   * @see         https://developer.wordpress.org/reference/functions/add_options_page/
   *
   * @since       0.1.0
   * @version     1.0.0
   */
  function <%= nameSafe %>_menu() {

    add_options_page(
      '<%= nameFriendly %>', // <title>
      '<%= nameAdminMenu %>', // menu
      'manage_options', // capability
      '<%= pluginUrlAdminMenu %>', // menu_slug
      '<%= nameSafe %>_options_page' // function callback
    );
  }

  add_action('admin_menu', '<%= nameSafe %>_menu');

}

if ( !function_exists( '<%= nameSafe %>_options_create' ) ) {

  /**
   * Create the default plugin options
   *  This is called when the plugin is activated,
   *  so that it is available to all functions including shortcodes.
   */
  function <%= nameSafe %>_options_create() {

    /**
     * Set option defaults
     */
    $<%= nameSafe %>_options_default = array(
      '<%= nameSafe %>_username' => __('Default User 1', '<%= name %>'),
      '<%= nameSafe %>_datatype' => __('photos', '<%= name %>')
    );

    /**
     * Load any existing options, falling back to an empty array if they don't exist yet
     * @see https://developer.wordpress.org/reference/functions/get_option/#parameters
     */
    $<%= nameSafe %>_options = get_option( '<%= nameSafe %>', array() );

    /**
     * Merge defaults with existing options
     * This overwrites the defaults with any user specified values
     */
    $<%= nameSafe %>_options_combined = array_merge ( $<%= nameSafe %>_options_default, $<%= nameSafe %>_options );

    /**
     * Save options objectback to database
     *
     * Update the plugin data stored in the WP Options table
     * This function may be used in place of add_option, although it is not as flexible.
     * update_option will check to see if the option already exists.
     * If it does not, it will be added with add_option('option_name', 'option_value').
     * Unless you need to specify the optional arguments of add_option(),
     * update_option() is a useful catch-all for both adding and updating options.
     * @example update_option( string $option, mixed $value, string|bool $autoload = null )
     * @see https://codex.wordpress.org/Function_Reference/update_option
     */
    update_option( '<%= nameSafe %>', $<%= nameSafe %>_options_combined, null );
  }
}

/**
 * Create the plugin options page
 */
if ( !function_exists( '<%= nameSafe %>_options_page' ) ) {

  /**
   * Render the appropriate UI on Settings > <%= nameFriendly %>
   *
   *    1. Take the user's options (from the form input)
   *    2. Store the user's options
   *    3. Render the options page
   *
   *    Note: Shortcode/widget options are specific to each instance of the shortcode/widget
   *    and are thus stored with those individual instances.
   *
   * @since       0.1.0
   * @version     1.0.0
   */
  function <%= nameSafe %>_options_page() {

    if ( ! current_user_can( 'manage_options' ) ) {
      wp_die( 'Sorry, you do not have sufficient permissions to access this page.' );
    }

    /**
     * Make this global available within the required statement
     */
    global $<%= nameSafe %>_options;

    /**
     * Load existing options
     */
    $<%= nameSafe %>_options = get_option( '<%= nameSafe %>' );

    /**
     * If the form was submitted, update the options
     */
    if ( isset( $_POST['<%= nameSafe %>_form_submitted'] ) ) {

      // check that the form submission was legitimate
      $hidden_field = esc_html( $_POST['<%= nameSafe %>_form_submitted'] );

      if ( $hidden_field !== 'Y' ) {
        return;
      }

      /**
       * Save default/user values from form submission
       * @see https://stackoverflow.com/a/13461680/6850747
       * @todo https://github.com/dotherightthing/generator-wp-plugin-boilerplate/issues/16
       * @todo https://github.com/dotherightthing/generator-wp-plugin-boilerplate/issues/17
       */
      foreach( $<%= nameSafe %>_options as $key => $value ) {

        // if a value was submitted
        if ( !empty( $_POST[ $key ] ) ) {
          // overwrite the existing value
          $<%= nameSafe %>_options[ $key ] = esc_html( $_POST[ $key ] );
        }
        else {
          // if a checkbox's unchecked option
          // value="1"
          if ( ( $key === '<%= nameSafe %>_slidedown' ) || ( $key === '<%= nameSafe %>_reveal_labels') ) {
            // also overwrite the existing value
            $<%= nameSafe %>_options[ $key ] = '';
          }
          // if a select's default option
          // value=""
          if ( $key === '<%= nameSafe %>_datatype' ) {
            // also overwrite the existing value
            $<%= nameSafe %>_options[ $key ] = '';
          }
        }
      }

      // Update options object in database
      update_option( '<%= nameSafe %>', $<%= nameSafe %>_options, null );
    }

    /**
     * Use the options to get the data
     */
    if ( function_exists('<%= nameSafe %>_api_request') ) {

      // Call API and store response in options object
      $<%= nameSafe %>_options['<%= nameSafe %>_data'] = <%= nameSafe %>_api_request();

      // Store timestamp in options object
      $<%= nameSafe %>_options['last_updated'] = time(); // UNIX timestamp for the current time

      // Update options object in database
      update_option( '<%= nameSafe %>', $<%= nameSafe %>_options, null );
    }

    // Create variables from options
    $<%= nameSafe %>_username = null;
    $<%= nameSafe %>_datatype = null;
    $<%= nameSafe %>_data = null;

    // Assign values to variables
    extract( $<%= nameSafe %>_options, EXTR_IF_EXISTS );

    /**
     * Load the HTML template
     * This function's variables will be available to this template.
     */
    require_once(<%= constantStub %>_PATH . 'templates/<%= name %>-options.php');
  }

}

if ( !function_exists( '<%= nameSafe %>_options_page_field' ) ) {

  /**
   * Form field templating for the options page
   *
   * @since       0.6.0
   * @version     1.0.0
   */
  function <%= nameSafe %>_options_page_field( $type, $name, $label, $tip=null ) {

    // Load options array
    $<%= nameSafe %>_options = get_option( '<%= nameSafe %>' );

    // Create variables
    $<%= nameSafe %>_username = null;
    $<%= nameSafe %>_datatype = null;

    // Assign values to variables
    extract( $<%= nameSafe %>_options );

    /**
     * Set the value to the variable with the same name as the $name string
     * e.g. $name="<%= nameSafe %>_toggle_label" => $<%= nameSafe %>_toggle_label => ('Open menu', '<%= name %>')
     * @see http://php.net/manual/en/language.variables.variable.php
     */

    // if the option doesn't exist yet, don't output it
    if ( ! isset( ${$name} ) ) {
      return;
    }

    $value = ${$name};

    /**
     * Load the HTML template
     * The supplied arguments will be available to this template.
     */

    /**
     * ob_start — Turn on output buffering
     * This stores the HTML template in the buffer
     * so that it can be output into the content
     * rather than at the top of the page.
     */
    ob_start();

    require(<%= constantStub %>_PATH . 'templates/<%= name %>-options-' . $type . '.php');

    /**
     * ob_get_clean — Get current buffer contents and delete current output buffer
     */
    return ob_get_clean();
  }

}

?>
