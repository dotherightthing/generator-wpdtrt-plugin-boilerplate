<?php
/**
 * Template partial for Admin Options page
 *    WP Admin > Settings > <%= nameFriendly %>
 *
 * @uses        WordPress_Admin_Style
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/templates
 * @since     0.1.0
 * @version   1.0.0
 */
?>

<div class="wrap">

  <div id="icon-options-general" class="icon32"></div>
  <h1>
    <?php esc_attr_e( '<%= nameFriendly %>', '<%= name %>' ); ?>
    <span class="<%= name %>-version"><?php echo <%= constantStub %>_VERSION; ?></span>
  </h1>

  <?php
  /**
   * If the user has not chosen a content type yet.
   * then $<%= nameSafe %>_datatype will be set to the default of ""
   * The user must make a selection so that we know which page to query,
   * so we show the selection form.
   *
   * selected
   * Compares two given values (for example, a saved option vs. one chosen in a form) and,
   * if the values are the same, adds the selected attribute to the current option tag.
   * @link https://codex.wordpress.org/Function_Reference/selected
   */
  ?>
  <form name="<%= nameSafe %>_data_form" method="post" action="">

    <input type="hidden" name="<%= nameSafe %>_form_submitted" value="Y" />

    <h2 class="title"><?php esc_attr_e('General Settings', '<%= name %>'); ?></h2>
    <p><?php _e('Please enter your preferences.', '<%= name %>'); ?></p>

    <fieldset>
      <legend class="screen-reader-text">
        <span><?php esc_attr_e('Settings', '<%= name %>'); ?></span>
      </legend>
      <table class="form-table">
        <tbody>
          <?php
          /*
            echo <%= nameSafe %>_options_page_field(
              'textfield',
              '<%= nameSafe %>_colour',
              __('Your favourite colour', '<%= name %>')
            );
          */
          ?>
          <tr>
            <th scope="row">
              <label for="<%= nameSafe %>_datatype">
                <?php _e('Data type', '<%= name %>'); ?>
              </label>
            </th>
            <td>
              <select name="<%= nameSafe %>_datatype" id="<%= nameSafe %>_datatype">
                <option value="">None</option>
                <option value="photos" <?php selected( $<%= nameSafe %>_datatype, "photos" ); ?>><?php _e('Coloured blocks', '<%= name %>'); ?></option>
                <option value="users" <?php selected( $<%= nameSafe %>_datatype, "users" ); ?>><?php _e('Maps', '<%= name %>'); ?></option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
    </fieldset>

    <?php
    /**
     * submit_button( string $text = null, string $type = 'primary', string $name = 'submit', bool $wrap = true, array|string $other_attributes = null )
     */
      submit_button(
        $text = __('Save Changes', '<%= name %>'),
        $type = 'primary',
        $name = '<%= nameSafe %>_submit',
        $wrap = true, // wrap in paragraph
        $other_attributes = null
      );
    ?>

  </form>

  <?php
    /**
     * If the user has already chosen a content type,
     * then $<%= nameSafe %>_data will exist and contain the body of the resulting JSON.
     * We display a sample of the data, so the user can verify that they have chosen the type
     * which meets their needs.
     */
    if ( isset( $<%= nameSafe %>_data ) ) :
  ?>

  <h2>
    <span><?php esc_attr_e( 'Sample content', '<%= name %>' ); ?></span>
  </h2>

  <p>This data set contains <?php echo count( $<%= nameSafe %>_data ); ?> items.</p>

  <p>The first 6 are displayed below:</p>

  <?php do_shortcode( '[<%= nameSafe %> number="6"]' ); ?>

  <?php
  /**
   * For the purposes of debugging, we also display the raw data.
   * var_dump is prefereable to print_r,
   * because it reveals the data types used,
   * so we can check whether the data is in the expected format.
   * @link http://kb.dotherightthing.co.nz/php/print_r-vs-var_dump/
   */

  // the data set
  $<%= nameSafe %>_options = get_option('<%= nameSafe %>');

  $last_updated = $<%= nameSafe %>_options['last_updated'];

  // use the date format set by the user
  $wp_date_format = get_option('date_format');
  $wp_time_format = get_option('time_format');

  $last_updated_str = date( $wp_time_format, $last_updated ) . ', ' . date( $wp_date_format, $last_updated );
  ?>

  <h2>
    <span><?php esc_attr_e( 'Sample data', '<%= name %>'); ?></span>
  </h2>

  <p>The data used to generate the content above.</p>

  <div class="<%= name %>-data"><pre><code><?php echo "{\r\n";

      $count = 0;
      $max_length = 6;

      foreach( $<%= nameSafe %>_data as $key => $val ) {
        var_dump( $<%= nameSafe %>_data[$key] );

        $count++;

        // when we reach the end of the sample, stop looping
        if ($count === $max_length) {
          break;
        }

      }

      echo "}\r\n"; ?></code></pre></div>

    <p class="<%= name %>-date"><em><?php _e('Data generated:', '<%= name %>'); echo ' ' . $last_updated; ?></em></p>

  <?php
    endif;
  ?>

</div> <!-- .wrap -->
