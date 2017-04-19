/**
 * Scripts for the public front-end
 *
 * This file contains JavaScript.
 * PHP variables are provided in the ajax_object.
 *
 * @link       http://www.dotherightthing.co.nz/
 * @since      1.0.0
 *
 * @package    DTRT_Plugin_Boilerplate
 * @subpackage DTRT_Plugin_Boilerplate/public/js
 */

jQuery(document).ready(function($){

	$('.wpdtrt-badge').hover(function() {
		$(this).find('.wpdtrt-badge-info').stop(true, true).fadeIn(200);
	}, function() {
		$(this).find('.wpdtrt-badge-info').stop(true, true).fadeOut(200);
	});

  $.post( ajax_object.ajax_url, {
    action: 'wpdtrt_plugin_boilerplate_data_refresh'
  }, function( response ) {
    //console.log( 'Ajax complete' );
  });

});
