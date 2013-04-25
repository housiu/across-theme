<?php

	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	register_taxonomy( 'program_name', 
    	array( 'program' , 'gallery' , 'announcement'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Program Name', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Program Name', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Program', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'Program Name', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Program Name', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Program Name:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Program Name', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Program Name', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Program Name', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Program Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'program-name' ),
    	)
    );   
	 
	// now let's add custom tags (these act like categories)
    register_taxonomy( 'program_type', 
    	array('program' , 'announcement' ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Program Tag', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Program Tag', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Program Tags', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'Program Tags', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Program Tag', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Program Tag:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Program Tag', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Program Tag', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Program Tag', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Program Tag Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 
    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */
	

	register_taxonomy( 'announcement_type', 
    	array( 'announcement' ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Announcement Type', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Announcement', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Announcement', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'Announcements', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Announcement', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Announcement:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Announcement', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Announcement', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Announcement', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Announcement', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'announcement_type' ),
    	)
    );  

?>