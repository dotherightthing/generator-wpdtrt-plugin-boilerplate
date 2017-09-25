/**
 * Scripts for the public front-end
 *
 * This file contains JavaScript.
 *    PHP variables are provided in <%= nameSafe %>_config.
 *
 * @package     <%= nameFriendlySafe %>
 * @subpackage  <%= nameFriendlySafe %>/js
 * @since       0.1.0
 */

jQuery(document).ready(function($){

	$('.<%= name %>-badge').hover(function() {
		$(this).find('.<%= name %>-badge-info').stop(true, true).fadeIn(200);
	}, function() {
		$(this).find('.<%= name %>-badge-info').stop(true, true).fadeOut(200);
	});

  $.post( <%= nameSafe %>_config.ajax_url, {
    action: '<%= nameSafe %>_data_refresh'
  }, function( response ) {
    //console.log( 'Ajax complete' );
  });

});
