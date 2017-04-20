<?php
/**
 * Template partial for Admin Options page
 * WP Admin > Settings > DTRT Plugin Boilerplate
 *
 * This file contains PHP, and HTML from the WordPress_Admin_Style plugin.
 *
 * @link       http://www.dotherightthing.co.nz/
 * @link       /wp-admin/admin.php?page=WordPress_Admin_Style#twocolumnlayout2
 * @since      1.0.0
 *
 * @package    DTRT_Plugin_Boilerplate
 * @subpackage DTRT_Plugin_Boilerplate/admin/partials
 */
?>

<div class="wrap">

  <div id="icon-options-general" class="icon32"></div>
  <h1><?php esc_attr_e( 'DTRT Plugin Boilerplate', 'wp_admin_style' ); ?></h1>

  <div id="poststuff">

    <div id="post-body" class="metabox-holder columns-2">

      <!-- main content -->
      <div id="post-body-content">

        <div class="meta-box-sortables ui-sortable">

          <?php if ( !isset( $wpdtrt_username ) || ( $wpdtrt_username === '') ) : ?>

          <div class="postbox">

            <div class="handlediv" title="Click to toggle"><br></div>
            <!-- Toggle -->

            <h2 class="hndle">
              <span><?php esc_attr_e( 'Let\'s Get Started', 'wp_admin_style' ); ?></span>
            </h2>

            <div class="inside">

              <form name="wpdtrt_username_form" method="post" action="">

                <input type="hidden" name="wpdtrt_form_submitted" value="Y" />

                <table class="form-table">
                  <tr>
                    <td>
                      <label for="wpdtrt_username">Username</label>
                    </td>
                    <td>
                      <input type="text" value="" class="regular-text" name="wpdtrt_username" id="wpdtrt_username" />
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
                    $name = 'wpdtrt_username_submit',
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

              <ul class="wpdtrt-badges">


                <?php
                  $total_badges = count( $wpdtrt_data->{'badges'} );

                  for( $i = $total_badges - 1; $i >= $total_badges - 20; $i-- ):
                ?>
                <li>
                  <ul>
                    <li>
                      <img width="120px" src="<?php echo $wpdtrt_data->{'badges'}[$i]->{'icon_url'}; ?>">
                    </li>

                    <?php if( $wpdtrt_data->{'badges'}[$i]->{'url'} != $wpdtrt_data->{'profile_url'} ): ?>

                    <li class="wpdtrt-badge-name">
                      <a href="<?php echo $wpdtrt_data->{'badges'}[$i]->{'url'}; ?>">
                        <?php echo $wpdtrt_data->{'badges'}[$i]->{'name'}; ?>
                      </a>
                    </li>
                    <li class="wpdtrt-project-name">
                      <a href="<?php echo $wpdtrt_data->{'badges'}[$i]->{'courses'}[0]->{'url'}; ?>"><?php echo $wpdtrt_data->{'badges'}[$i]->{'courses'}[0]->{'title'}; ?></a>
                    </li>

                    <?php else: ?>

                    <li class="wpdtrt-badge-name">
                      <?php echo $wpdtrt_data->{'badges'}[$i]->{'name'}; ?>
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

            <h2 class="hndle"><span><?php esc_attr_e( $wpdtrt_username . '\'s profile data', 'wp_admin_style'); ?></span></h2>

            <div class="inside">

              <ul>
                <li>name: <?php echo $wpdtrt_data->{'name'}; ?></li>
                <li>profile_url: <?php echo $wpdtrt_data->{'profile_url'}; ?></li>
                <li>number of badges: <?php echo count( $wpdtrt_data->{'badges'} ); ?>
                  <ol>
                  <?php
                    $badges = $wpdtrt_data->{'badges'};

                    foreach ( $badges as $badge ) {
                    //echo "<li>name: " . $badge->{'name'} . "</li>";
                      echo "<li>name: {$badge->{'name'}}</li>";
                    }

                    // this is equivalent to:
                    /*
                    for ($i = 0; $i < count($badges); $i++ ) {
                      //echo "<li>name: " . $wpdtrt_data->{'badges'}[$i]->{'name'} . "</li>";
                      echo "<li>name: {$wpdtrt_data->{'badges'}[$i]->{'name'}}</li>";
                    }
                    */
                    ?>
                </li>
              </ul>

              <pre><code>
                <?php var_dump( $wpdtrt_data ); ?>
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

          <?php if ( isset( $wpdtrt_username ) && ( $wpdtrt_username !== '') ) : ?>

          <div class="postbox">

            <div class="handlediv" title="Click to toggle"><br></div>
            <!-- Toggle -->

            <h2 class="hndle"><span><?php esc_attr_e( $wpdtrt_username . '\'s Profile', 'wp_admin_style'); ?></span></h2>

            <div class="inside">
              <p><img width="100%" class="wpdtrt-gravatar" src="<?php echo $wpdtrt_data->{'gravatar_url'}; ?>" alt="<?php esc_attr_e( $wpdtrt_username ); ?>. "></p>

              <ul class="wpdtrt-badges-and-points">
                <li>Badges: <strong><?php echo count( $wpdtrt_data->{'badges'} ); ?></strong></li>
                <li>Points: <strong><?php echo $wpdtrt_data->{'points'}->{'total'}; ?></strong></li>
              </ul>

              <form name="wpdtrt_username_form" method="post" action="">

                <input type="hidden" name="wpdtrt_form_submitted" value="Y" />

                <p>
                  <label for="wpdtrt_username">Username</label>
                </p>
                <p>
                  <input type="text" value="<?php echo $wpdtrt_username; ?>" name="wpdtrt_username" id="wpdtrt_username" />

                  <?php
                    submit_button(
                      $text = 'Update',
                      $type = 'primary',
                      $name = 'wpdtrt_username_submit',
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
