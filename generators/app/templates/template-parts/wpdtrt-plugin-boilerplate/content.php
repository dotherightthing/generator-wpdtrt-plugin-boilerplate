<?php
/**
 * File: template-parts/<%= name %>/content.php
 *
 * Template to display plugin output in shortcodes and widgets
 *
 * Since:
 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
 */

// Predeclare variables
//
// Internal WordPress arguments available to widgets
// This allows us to use the same template for shortcodes and front-end widgets.
$before_widget = null; // register_sidebar.
$before_title  = null; // register_sidebar.
$title         = null;
$after_title   = null; // register_sidebar.
$after_widget  = null; // register_sidebar.

// shortcode options
// $foo = null;
//
// access to plugin.
$plugin = null;

// Options: display $args + widget $instance settings + access to plugin.
$options = get_query_var( 'options' );

// Overwrite variables from array values
// http://kb.network.dan/php/wordpress/extract/.
extract( $options, EXTR_IF_EXISTS );

// load the data
// $plugin->get_api_data();
// $foo = $plugin->get_api_data_bar();
//
// WordPress widget options (not output with shortcode).
echo $before_widget;
echo $before_title . $title . $after_title;
?>

<div class="<%= name %>">
	<?php
		/* ====== Add plugin output here ====== */
	?>
</div>

<?php
// output widget customisations (not output with shortcode).
echo $after_widget;
?>
