jQuery(document).ready(function($){

	$('.wpdtrt-badge').hover(function() {
		$(this).find('.wpdtrt-badge-info').stop(true, true).fadeIn(200);
	}, function() {
		$(this).find('.wpdtrt-badge-info').stop(true, true).fadeOut(200);
	});

  $.post( ajaxurl, {
   // wpdtrt_plugin_boilerplate_data_refresh
    action: 'wp_ajax_wpdtrt_plugin_boilerplate_data_refresh'
  }, function( response ) {
    console.log( 'Ajax complete' );
  });

});