<?php
/**
 * Template partial for the public front-end
 *
 * This file contains PHP, and HTML.
 *
 * @link       <%= pluginUrl %>
 * @since      0.1.0
 *
 * @package    <%= nameFriendlySafe %>
 * @subpackage <%= nameFriendlySafe %>/public/partials
 */
?>

<?php
  // output widget customisations (not output with shortcode)
  echo $before_widget;
  echo $before_title . $title . $after_title;
?>

<ul class="<%= name %>-badges frontend">

  <?php

    $total_badges = count( $<%= nameSafe %>_data->{'badges'} );

    for( $i = $total_badges - 1; $i >= $total_badges - $num_badges; $i-- ):

  ;?>

  <li class="<%= name %>-badge">

    <img src="<?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'icon_url'}; ?>">


    <?php if ( $display_tooltips == '1' ): ?>


      <div class="<%= name %>-badge-info">

        <p class="<%= name %>-badge-name">
          <a href="<?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'url'};; ?>">
            <?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'name'}; ?>
          </a>
        </p>

        <?php if ( $<%= nameSafe %>_data->{'badges'}[$i]->{'courses'}[1]->{'title'} != '' ): ?>

        <p class="<%= name %>-badge-project">
          <a href="<?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'courses'}[1]->{'url'}; ?>">
            <?php echo $<%= nameSafe %>_data->{'badges'}[$i]->{'courses'}[1]->{'title'} ;?>
          </a>
        </p>
        <?php endif; ?>

        <a href="http://teamtreehouse.com" alt="Team Treehouse | A Better Way to Learn Technology" class="<%= name %>-logo">
          <img src="<?php echo <%= constantStub %>_URL . 'views/public/images/treehouse-logo.png'; ?>" alt="Treehouse" />
        </a>

        <span class="<%= name %>-tooltip bottom"></span>

      </div>

    <?php endif; ?>

  </li>

  <?php endfor; ?>

</ul>


<?php
  // output widget customisations (not output with shortcode)
  echo $after_widget;
?>
