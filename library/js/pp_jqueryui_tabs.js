/*
Program Page Tabs - jQuery UI
*/
jQuery.noConflict();
jQuery(document).ready(function ($) {
	$('#tabs').tabs( 
			{ hide: { effect: "fade", direction: 'right', duration: 200 } } ,
			{ show: { effect: "fade", direction: 'down', duration: 500 } } 						
		)
		.addClass('ui-tabs-vertical ui-helper-clearfix')
	$('#main-tab').hide();
});
