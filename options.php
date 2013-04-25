<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data

	$flickrset_array = array(
		'set' => __('Set', 'options_framework_theme'),
		'collection' => __('Collection', 'options_framework_theme'),
	);

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = '';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}



	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	// Header options Start

	$options[] = array(
		'name' => __('Header Options', 'options_framework_theme'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Facebook URL', 'options_framework_theme'),
		'desc' => __('Enter Facebook URL.', 'options_framework_theme'),
		'id' => 'facebookurl',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter URL', 'options_framework_theme'),
		'desc' => __('Enter Twitter URL.', 'options_framework_theme'),
		'id' => 'twitterurl',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('YouTube URL', 'options_framework_theme'),
		'desc' => __('Enter YouTube URL.', 'options_framework_theme'),
		'id' => 'youtubeurl',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('YouTube URL', 'options_framework_theme'),
		'desc' => __('Enter YouTube URL.', 'options_framework_theme'),
		'id' => 'youtubeurl',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Shopping Cart Page', 'options_framework_theme'),
		'desc' => __('Select Shopping Cart Page', 'options_framework_theme'),
		'id' => 'shoppingcarturl',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('Upload Logo', 'options_framework_theme'),
		'desc' => __('Upload the Header Logo file. Prefer PNG files.', 'options_framework_theme'),
		'id' => 'headerlogo',
		'type' => 'upload');
	
	// Header options Ends
	
	// footer options Start
	
	$options[] = array(
		'name' => __('Footer Options', 'options_framework_theme'),
		'type' => 'heading');
	
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	for ($i = 1; $i <= 4; $i++) {
		$footer_id = 'footer' . $i;
		$footer_name = 'Footer Column #' . $i;
		$footer_desc = 'Input Content for Column #' . $i;
		
		$options[] = array(
			'name' => __( $footer_name , 'options_framework_theme'),
			'desc' => __( $footer_desc , 'options_framework_theme' ),
			'id' => $footer_id,
			'type' => 'editor',
			'settings' => $wp_editor_settings );
	}
		
	// footer options Ends

	// Gallery Options Start

	$options[] = array(
		'name' => __('Gallery', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Flickr User ID', 'options_framework_theme'),
		'desc' => __('Please enter Flickr User ID - Across U-hub ID : 71262322@N08', 'options_framework_theme'),
		'id' => 'flickrid',
		'type' => 'text');

	$options[] = array(
		'name' => __('Flickr API Key', 'options_framework_theme'),
		'desc' => __('Please enter Flickr API Key - Across U-hub API Key : 8905278cfedacf3e387a7315dba78f7c', 'options_framework_theme'),
		'id' => 'flickrapikey',
		'type' => 'text');

	$options[] = array(
		'name' => __('Flickr Photo Set', 'options_framework_theme'),
		'desc' => __('Select Set or Collection - Across U-hub : Set', 'options_framework_theme'),
		'id' => 'flickrset',
		'std' => 'Set',
		'type' => 'radio',
		'options' => $flickrset_array);
	
	// Gallery Options End

	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}