<?php
/*
Author: John Sio
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

include_once dirname (__FILE__) . '/metaboxes/setup.php';

include_once dirname (__FILE__) . '/metaboxes/gallery_cpt-spec.php';

include_once dirname (__FILE__) . '/metaboxes/pp_option-spec.php';

include_once dirname (__FILE__) . '/metaboxes/hp_qf-spec.php';

include_once dirname (__FILE__) . '/metaboxes/hp_bot-spec.php';

include_once dirname (__FILE__) . '/metaboxes/annoucement-spec.php';

include_once dirname (__FILE__) . '/metaboxes/hp_slider-spec.php';

/************** END of WPA *********************/

function my_em_has_attribute_event_output_condition($replacement, $condition, $match, $EM_Event){

	// Attribute_1
	if( is_object($EM_Event) && preg_match('/^has_sku$/',$condition, $matches) ){
		if( !in_array($args['sku'],$EM_Event->event_attributes) && !empty($EM_Event->event_attributes['sku']) ){
			$replacement = preg_replace("/\{\/?$condition\}/", '', $match);
		}else{
			$replacement = '';
		}
	}
	return $replacement;
}
add_action('em_event_output_condition', 'my_em_has_attribute_event_output_condition', 1, 4);

/**** WALKER *******/

class MegaDropDown extends Walker_Nav_Menu {
	
	function start_el(&$output, $item, $depth, $args) {
			
    	global $wp_query;
	    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	    
	    $class_names = $value = '';
    	
        $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

        $class_names = join( ' ' , apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        
        
        
        ! empty ( $class_names )
            and $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes  = '';

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';
        
        // insert description for top level elements only
        // you may change this
        $description = ( ! empty ( $item->description ) and 0 == $depth )
            ? '<small class="nav_desc">' . esc_attr( $item->description ) . '</small>' : '';

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . $title . $depth //. '-' . $item->ID
            . '</a> '
            . $args->link_after
            . $description
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters( 'walker_nav_menu_start_el' , $item_output , $item, $depth, $args );
        
    }
    
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		
		if ( !$element )
			return;
		
		//Add indicators for top level menu items with submenus
		$id_field = $this->db_fields['id'];
		if ( ( $depth == 1 && !empty( $children_elements[ $element->$id_field ] ) ) || $depth == 1 ) {
			$element->classes[] = 'depth' . $depth;
		}
		
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

	}
	
    function start_lvl(&$output, $depth , $args) {
	    
    	if ( $depth == 0 ) {
    		$output .= '<div class="drop">';
		}
    	$output .= '<ul class="mega_list">';
		
		return;
	}
	
	function end_lvl(&$output, $depth) {
		$output .= '</ul>';
		if ( $depth == 0 ) $output .= '</div>';
		return;
	}
	
	
   
}

function check_for_submenu($classes, $item) {
    global $wpdb;
    //$has_children = $wpdb->get_var("SELECT COUNT(meta_id) FROM wp_postmeta WHERE meta_key='_menu_item_menu_item_parent' AND meta_value='" . $item->ID . "'" );
    
    //SELECT count(meta_value) FROM wp_postmeta where meta_value in ( select post_id from wp_postmeta where meta_key='_menu_item_menu_item_parent' and meta_value='3005' ) and meta_key='_menu_item_menu_item_parent' group by meta_value having count(meta_value) > 1
    
    $has_children = $wpdb->get_results("SELECT count(meta_value) FROM wp_postmeta where meta_value in ( select post_id from wp_postmeta where meta_key='_menu_item_menu_item_parent' and meta_value='" . $item->ID . "' ) and meta_key='_menu_item_menu_item_parent' group by meta_value having count(meta_value) > 0");
    
    $num_rows = $wpdb->num_rows;
    
    if ( $num_rows > 0 ) {
	    $child_class = 'setcol' . $num_rows;
	    array_push($classes, $child_class);
    }
    return $classes;
}
 
add_filter( 'nav_menu_css_class', 'check_for_submenu', 10,2);


/************** Gallery Functions *********************/

require_once ( dirname (__FILE__) . '/library/gallery_functions.php');
require_once ( dirname (__FILE__) . '/library/shortcode.php');

/************** End of Gallery Function Include *********************/

add_action( 'wp_enqueue_scripts', 'highslide_js_script' );

// HighSlide JS  -- call at HOME page
function highslide_js_script()  {  
    wp_register_script( 'jquery_highslide', get_template_directory_uri() . '/library/js/highslide/highslide-full.js' );  

    wp_enqueue_script( 'jquery_highslide' );  
}  
// Highslide CSS
add_action( 'wp_enqueue_scripts', 'highslide_js_style' ); 
function highslide_js_style()  {  
    wp_register_style( 'highslide-style', get_template_directory_uri() . '/library/js/highslide/highslide.css', array(), '20130314', 'all' );  
    wp_enqueue_style( 'highslide-style' );  
}  

// Activate Highslider - used in the Program Page
function highslide_activate() {
	wp_register_script( 'pp_highslide', get_template_directory_uri() . '/library/js/highslide/pp_highslide.js' );
	wp_enqueue_script( 'pp_highslide' ); 
}

// flexslider JS -- call at HOME page
function flexslider_js_script()  {  
    wp_register_script( 'jquery_flexslider', get_template_directory_uri() . '/library/js/flexslider/jquery.flexslider-min.js' );  
    wp_enqueue_script( 'jquery_flexslider' );  
}  
// flexslider CSS
function flexslider_js_style()  {  
    wp_register_style( 'flexslider-style', get_template_directory_uri() . '/library/js/flexslider/flexslider.css', array(), '20130314', 'all' );  
    wp_enqueue_style( 'flexslider-style' );  
} 
function flexslider_activate() {
	wp_register_script( 'hp_flexslider', get_template_directory_uri() . '/library/js/flexslider/hp_flexslider.js' );
	wp_enqueue_script( 'hp_flexslider' ); 
}

/************** custom script enqueue *********************/

function jquery_ui_function() {
	wp_enqueue_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js', array('jquery'), '1.9.1');
}
add_action('wp_enqueue_scripts', 'jquery_ui_function');

function pp_jqueryui_tabs_function() {
	wp_enqueue_script( 'pp_jqueryui_tabs',	get_template_directory_uri() . '/library/js/pp_jqueryui_tabs.js', array( 'jquery' ) );
}

function pp_jqueryui_accordion_function() {
	wp_enqueue_script( 'pp_jqueryui_accordion',	get_template_directory_uri() . '/library/js/pp_jqueryui_accordion.js', array( 'jquery' ) );
}
// function for creating wp_editor in the Metaboxes
function my_admin_print_footer_scripts()
{
    ?><script type="text/javascript">/* <![CDATA[ */
        jQuery(function($)
        {
            var i=1;
            $('.customEditor textarea').each(function(e)
            {
                var id = $(this).attr('id');
 
                if (!id)
                {
                    id = 'customEditor-' + i++;
                    $(this).attr('id',id);
                }
 
                tinyMCE.execCommand('mceAddControl', false, id);
                 
            });
        });
    /* ]]> */</script><?php
}


/************** END script enqueue *********************/


/**** Theme Option Page ******/

if ( !function_exists( 'optionsframework_init' ) ) {

	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );

	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
	
}

/**** End Theme Option Page ******/



/*
add_action('init', 'include_metabox_init_file');
function include_metabox_init_file() {
    // use correct path here
    require_once get_stylesheet_directory() . '/metabox/init.php';
	
}

require_once get_stylesheet_directory() . '/metabox/example-functions.php';
require_once get_stylesheet_directory() . '/metabox/mb_program_page.php';
*/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
//require_once('library/custom-post-type.php'); // you can disable this if you like

require_once('library/program-cpt.php');
require_once('library/gallery-cpt.php');
require_once('library/announcement-cpt.php');
require_once('library/taxonomy.php');
require_once('library/slider-cpt.php');
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __('Sidebar 1', 'bonestheme'),
		'description' => __('The first (primary) sidebar.', 'bonestheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	
	register_sidebar(array(
		'id' => 'pp_sidebar',
		'name' => __('Program Page Side Bar', 'bonestheme'),
		'description' => __('Half Tabs and Half custom Widget.', 'bonestheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __('Sidebar 2', 'bonestheme'),
		'description' => __('The second (secondary) sidebar.', 'bonestheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>', 'bonestheme'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'bonestheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
	</form>';
	return $form;
} // don't remove this bracket!


?>
