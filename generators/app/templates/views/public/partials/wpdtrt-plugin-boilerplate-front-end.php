<?php
/**
 * Template partial for the public front-end
 *
 * This file contains PHP, and HTML.
 *
 * @link       http://www.dotherightthing.co.nz/
 * @since      1.0.0
 *
 * @package    DTRT_Plugin_Boilerplate
 * @subpackage DTRT_Plugin_Boilerplate/public/partials
 */
?>

<?php
  // output widget customisations (not output with shortcode)
  echo $before_widget;
  echo $before_title . $title . $after_title;
?>

<ul class="wpdtrt-badges frontend">

  <?php

    $total_badges = count( $wpdtrt_data->{'badges'} );

    for( $i = $total_badges - 1; $i >= $total_badges - $num_badges; $i-- ):

  ;?>

  <li class="wpdtrt-badge">

    <img src="<?php echo $wpdtrt_data->{'badges'}[$i]->{'icon_url'}; ?>">


    <?php if ( $display_tooltips == '1' ): ?>


      <div class="wpdtrt-badge-info">

        <p class="wpdtrt-badge-name">
          <a href="<?php echo $wpdtrt_data->{'badges'}[$i]->{'url'};; ?>">
            <?php echo $wpdtrt_data->{'badges'}[$i]->{'name'}; ?>
          </a>
        </p>

        <?php if ( $wpdtrt_data->{'badges'}[$i]->{'courses'}[1]->{'title'} != '' ): ?>

        <p class="wpdtrt-badge-project">
          <a href="<?php echo $wpdtrt_data->{'badges'}[$i]->{'courses'}[1]->{'url'}; ?>">
            <?php echo $wpdtrt_data->{'badges'}[$i]->{'courses'}[1]->{'title'} ;?>
          </a>
        </p>
        <?php endif; ?>

        <a href="http://teamtreehouse.com" alt="Team Treehouse | A Better Way to Learn Technology" class="wpdtrt-logo">
          <img src="<?php echo WPDTRT_PLUGIN_BOILERPLATE_URL . 'views/public/images/treehouse-logo.png'; ?>" alt="Treehouse" />
        </a>

        <span class="wpdtrt-tooltip bottom"></span>

      </div>

    <?php endif; ?>

  </li>

  <?php endfor; ?>

</ul>


<?php
  // output widget customisations (not output with shortcode)
  echo $after_widget;
?>
