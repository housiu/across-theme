<?php
	function slider_cpt() { 
		// creating (registering) the custom type 
		register_post_type( 'slider', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
			// let's now add all the options for this post type
			array('labels' => array(
				'name' => __('Slider', 'bonestheme'), /* This is the Title of the Group */
				'singular_name' => __('Sliders', 'bonestheme'), /* This is the individual type */
				'all_items' => __('Sliders', 'bonestheme'), /* the all items menu item */
				'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
				'add_new_item' => __('Add New Slider', 'bonestheme'), /* Add New Display Title */
				'edit' => __( 'Edit Slider', 'bonestheme' ), /* Edit Dialog */
				'edit_item' => __('Edit Slider', 'bonestheme'), /* Edit Display Title */
				'new_item' => __('New Slider', 'bonestheme'), /* New Display Title */
				'view_item' => __('View Slider', 'bonestheme'), /* View Display Title */
				'search_items' => __('Search Slider', 'bonestheme'), /* Search Custom Type Title */ 
				'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
				), /* end of arrays */
				'description' => __( 'Slider custom type post', 'bonestheme' ), /* Custom Type Description */
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 9, /* this is what order you want it to appear in on the left hand side menu */ 
				'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
				'rewrite'	=> array( 'slug' => 'slider', 'with_front' => false ), /* you can specify its url slug */
				'has_archive' => 'slider_archive', /* you can rename the slug here */
				'capability_type' => 'post',
				'hierarchical' => false,
				/* the next one is important, it tells what's enabled in the post editor */
				'supports' => array( 'title', 'excerpt' ,'thumbnail')
			) /* end of options */
		); /* end of register post type */
	}
	add_action( 'init', 'slider_cpt');
?>