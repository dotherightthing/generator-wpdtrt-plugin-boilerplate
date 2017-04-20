<?php
/**
 * Template partial for Admin Options page
 * WP Admin > Settings > <%= nameFriendly %>
 *
 * This file contains PHP, and HTML from the WordPress_Admin_Style plugin.
 *
 * @link       <%= pluginUrl %>
 * @link       /wp-admin/admin.php?page=WordPress_Admin_Style#twocolumnlayout2
 * @since      0.1.0
 *
 * @package    <%= nameFriendlySafe %>
 * @subpackage <%= nameFriendlySafe %>/admin/partials
 */
?>

<div class="wrap">

  <div id="icon-options-general" class="icon32"></div>
  <h1><?php esc_attr_e( '<%= nameFriendly %>', 'wp_admin_style' ); ?></h1>

  <div id="poststuff">

    <div id="post-body" class="metabox-holder columns-2">

      <!-- main content -->
      <div id="post-body-content">

        <div class="meta-box-sortables ui-sortable">

          <?php if ( !isset( $<%= nameSafe %>_username ) || ( $<%= nameSafe %>_username === '') ) : ?>

          <div class="postbox">

            <div class="handlediv" title="Click to toggle"><br></div>
            <!-- Toggle -->

            <h2 class="hndle">
              <span><?php esc_attr_e( 'Let\'s Get Started', 'wp_admin_style' ); ?></span>
            </h2>

            <div class="inside">

              <form name="<%= nameSafe %>_username_form" method="post" action="">

                <input type="hidden" name="<%= nameSafe %>_form_submitted" value="Y" />

                <table class="form-table">
                  <tr>
                    <td>
                      <label for="<%= nameSafe %>_username">Username</label>
                    </td>
                    <td>
                      <input type="text" value="" class="regular-text" name="<%= nameSafe %>_username" id="<%= nameSafe %>_username" />
                    </td>
                  </tr>
                </table>

                <?php
                /**
                 * submit_button( string $text = null, string $type = 'primary', string $name = 'submit', bool $wrap = true, array|string $other_attributes = null )
                 */
                  submit_button(
                    $text = 'Save',
                    $type = 'primary',
                    $name = '<%= nameSafe %>_username_submit',
                    $wrap = true,
                    $other_attributes = null
                  );
                ?>

              </form>
            </div>
            <!-- .inside -->

          </div>
          <!-- .postbox -->

          <?php else: ?>

          <div class="postbox">

            <div class="handlediv" title="Click to toggle"><br></div>
            <!-- Toggle -->

            <h2 class="hndle"><span><?php esc_attr_e( 'Most recent badges', 'wp_admin_style' ); ?></span>
            </h2>

            <div class="inside">

              <p>Below are your 20 most recent badges. </p>

              <ul class="<%= name %>-badges">


                <?php
                  $total_badges = count( $<%= nameSafe %>_data->{'badges'} );

                  for( $i = $total_badges - 1; ( ($i >= 0) && ( $i >= $total_badges - 20) ); $i-- ):

                ?>
                <li>
                  <ul>
                    <li>
                      <img width="120px" src="<?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'icon_url'}; ?>">
                    </li>

                    <?php if( $<%= nameSafe %>_data->{'badges'}[$i]->{'url'} != $<%= nameSafe %>_data->{'profile_url'} ): ?>

                    <li class="<%= name %>-badge-name">
                      <a href="<?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'url'}; ?>">
                        <?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'name'}; ?>
                      </a>
                    </li>
                    <li class="<%= name %>-project-name">
                      <a href="<?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'courses'}[0]->{'url'}; ?>"><?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'courses'}[0]->{'title'}; ?></a>
                    </li>

                    <?php else: ?>

                    <li class="<%= name %>-badge-name">
                      <?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'name'}; ?>
                    </li>

                    <?php endif; ?>

                  </ul>
                </li>
                <?php endfor; ?>

              </ul>

            </div>
            <!-- .inside -->

          </div>
          <!-- .postbox -->

          <div class="postbox">

            <div class="handlediv" title="Click to toggle"><br></div>
            <!-- Toggle -->

            <h2 class="hndle"><span><?php esc_attr_e( $<%= nameSafe %>_username . '\'s profile data', 'wp_admin_style'); ?></span></h2>

            <div class="inside">

              <ul>
                <li>name: <?php echo $<%= nameSafe %>_data->{'name'}; ?></li>
                <li>profile_url: <?php echo $<%= nameSafe %>_data->{'profile_url'}; ?></li>
                <li>number of badges: <?php echo count( $<%= nameSafe %>_data->{'badges'} ); ?>
                  <ol>
                  <?php
                    $badges = $<%= nameSafe %>_data->{'badges'};

                    foreach ( $badges as $badge ) {
                    //echo "<li>name: " . $badge->{'name'} . "</li>";
                      echo "<li>name: {$badge->{'name'}}</li>";
                    }

                    // this is equivalent to:
                    /*
                    for ($i = 0; $i < count($badges); $i++ ) {
                      //echo "<li>name: " . $<%= nameSafe %>_data->{'badges'}[$i]->{'name'} . "</li>";
                      echo "<li>name: {$<%= nameSafe %>_data->{'badges'}[$i]->{'name'}}</li>";
                    }
                    */
                    ?>
                </li>
              </ul>

              <pre><code>
                <?php var_dump( $<%= nameSafe %>_data ); ?>
              </code></pre>

            </div> <!-- .inside -->

          </div>
          <!-- .postbox -->

        <?php endif; ?>

        </div>
        <!-- .meta-box-sortables .ui-sortable -->

      </div>
      <!-- post-body-content -->

      <!-- sidebar -->
      <div id="postbox-container-1" class="postbox-container">

        <div class="meta-box-sortables">

          <?php if ( isset( $<%= nameSafe %>_username ) && ( $<%= nameSafe %>_username !== '') ) : ?>

          <div class="postbox">

            <div class="handlediv" title="Click to toggle"><br></div>
            <!-- Toggle -->

            <h2 class="hndle"><span><?php esc_attr_e( $<%= nameSafe %>_username . '\'s Profile', 'wp_admin_style'); ?></span></h2>

            <div class="inside">
              <p><img width="100%" class="<%= name %>-gravatar" src="<?php echo $<%= nameSafe %>_data->{'gravatar_url'}; ?>" alt="<?php esc_attr_e( $<%= nameSafe %>_username ); ?>. "></p>

              <ul class="<%= name %>-badges-and-points">
                <li>Badges: <strong><?php echo count( $<%= nameSafe %>_data->{'badges'} ); ?></strong></li>
                <li>Points: <strong><?php echo $<%= nameSafe %>_data->{'points'}->{'total'}; ?></strong></li>
              </ul>

              <form name="<%= nameSafe %>_username_form" method="post" action="">

                <input type="hidden" name="<%= nameSafe %>_form_submitted" value="Y" />

                <p>
                  <label for="<%= nameSafe %>_username">Username</label>
                </p>
                <p>
                  <input type="text" value="<?php echo $<%= nameSafe %>_username; ?>" name="<%= nameSafe %>_username" id="<%= nameSafe %>_username" />

                  <?php
                    submit_button(
                      $text = 'Update',
                      $type = 'primary',
                      $name = '<%= nameSafe %>_username_submit',
                      $wrap = false, // don't wrap in paragraph
                      $other_attributes = null
                    );
                  ?>
                </p>

              </form>

            </div> <!-- .inside -->

          </div>
          <!-- .postbox -->

          <?php endif; ?>

        </div>
        <!-- .meta-box-sortables -->

      </div>
      <!-- #postbox-container-1 .postbox-container -->

    </div>
    <!-- #post-body .metabox-holder .columns-2 -->

    <br class="clear">
  </div>
  <!-- #poststuff -->

</div> <!-- .wrap -->
