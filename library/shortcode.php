<?php
	function get_announcement_box ( $atts ) {
		
		extract( shortcode_atts( array(
			'type' => NULL,
			'program' => NULL,
			'number' => 99,
			'style' => '',
		), $atts ) );
		
		/*
			Style = contains the layout format for the shortcode (possible layout i.e. linkonly, box )
		*/
		
		if ( !is_null($type) ) $type_pieces = explode(",", $type);
		if ( !is_null($program) ) $program_pieces = explode("," , $program);
		
		if ( !is_null($style) ) $style_options = explode( ",", $style);
		
		
		$categories = array();
		$program_id = array();

		if ( !is_null ( $type_pieces )  ) {
			foreach ( $type_pieces as $search_term ) {
				$term = get_term_by ('slug' , $search_term, 'announcement_type' );
				array_push( $categories , $term->term_id );
			}
		}
		
		if ( !is_null( $program_pieces ) ) {
			foreach ( $program_pieces as $search_program ) {
				$term = get_term_by ('slug' , $search_program, 'program_name' );
				array_push( $program_id , $term->term_id );
			}
			$tax_query_args = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'announcement_type',
					'field' => 'id',
					'terms' => $categories,
				),
				array(
					'taxonomy' => 'program_name',
					'field' => 'id',
					'terms' => $program_id,
				)
			);
		} else {
			$tax_query_args = array(
				array(
					'taxonomy' => 'announcement_type',
					'field' => 'id',
					'terms' => $categories,
				),
			);
		}
		
		$args = array(
			'post_type' => 'announcement',
			'orderby' => 'date',
			'order' => 'desc',
			'tax_query' => $tax_query_args,
			'posts_per_page' => $number,
		);
		$query_posts = new WP_Query( $args );		

			
		$html .= '<div class="announcement_post_group_box">';				
	
		while ( $query_posts->have_posts() ) : $query_posts->the_post();
		
			$title = get_the_title();
			//$content = get_the_content();
			$except = get_the_excerpt();
			$formatted_content = apply_filters( 'the_content', $except );
			$author_url = bones_get_the_author_posts_link();
			$time1 = get_the_time('Y-m-j');
			$time2 = get_the_time('F jS, Y');
			$post_url = get_permalink();

						
			$html .= '<a href="' . $post_url . '">';
			
			$html .= '<div class="announcement_post_single_box">';				
			if (in_array('title', $style_options) ) $html .= '<h4>' . $title . '</h4>';
		
			$html .= $formatted_content;
			if (in_array('time', $style_options)) $html .= '<i>Posted on <time class="updated" datetime="' . $time1 . '" pubdate>' . $time2 . '</time></i>';
			$html .= '</div>';
			$html .= '</a>';
		
		endwhile;
			
		$html .= '</div> <!-- end of announcement_post_group_box -->';

		wp_reset_postdata();

		return $html;
	}
	add_shortcode('show_category_box', 'get_announcement_box');
	
	
	function get_announcement_list ( $atts ) {
		
		extract( shortcode_atts( array(
			'type' => NULL,
			'program' => NULL,
			'number' => 99,
			'style' => '',
			'link' => 'title',
		), $atts ) );

		
		if ( !is_null($type) ) $type_pieces = explode(",", $type);
		if ( !is_null($program) ) $program_pieces = explode("," , $program);
		
		if ( !is_null($style) ) $style_options = explode( ",", $style);
		
		
		$categories = array();
		$program_id = array();

		if ( !is_null ( $type_pieces )  ) {
			foreach ( $type_pieces as $search_term ) {
				$term = get_term_by ('slug' , $search_term, 'announcement_type' );
				array_push( $categories , $term->term_id );
			}
		}
		
		if ( !is_null( $program_pieces ) ) {
			foreach ( $program_pieces as $search_program ) {
				$term = get_term_by ('slug' , $search_program, 'program_name' );
				array_push( $program_id , $term->term_id );
			}
			$tax_query_args = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'announcement_type',
					'field' => 'id',
					'terms' => $categories,
				),
				array(
					'taxonomy' => 'program_name',
					'field' => 'id',
					'terms' => $program_id,
				)
			);
		} else {
			$tax_query_args = array(
				array(
					'taxonomy' => 'announcement_type',
					'field' => 'id',
					'terms' => $categories,
				),
			);
		}
		
		$args = array(
			'post_type' => 'announcement',
			'orderby' => 'date',
			'order' => 'desc',
			'tax_query' => $tax_query_args,
			'posts_per_page' => $number,
		);
		$query_posts = new WP_Query( $args );		

			
		$html .= '<div class="announcement_post_group_list">';				
		$html .= '<ul>';				

		while ( $query_posts->have_posts() ) : $query_posts->the_post();
		
			$title = get_the_title();
			//$content = get_the_content();
			$except = get_the_excerpt();
			$formatted_content = apply_filters( 'the_content', $except );
			$author_url = bones_get_the_author_posts_link();
			$time1 = get_the_time('Y-m-j');
			$time2 = get_the_time('F jS, Y');
			$post_url = get_permalink();
			
			$html .= '<li>';
			
			if ( $link == 'title' ){
				$html .= '<a href="' . $post_url . '">';
				$html .= '<h4>' . $title . '</h4>';
				$html .= '</a>';
				
			} else {
				
				if ( in_array('title', $style_options) ) $html .= '<h4>' . $title . '</h4>';
				if ( in_array('time', $style_options) ) $html .= '<time class="updated" datetime="' . $time1 . '" pubdate>' . $time2 . '</time>';
				if ( in_array('author', $style_options) ) $html .= 'by <span class="author">' . $author_url . '</span>';

				$html .= '<a href="' . $post_url . '">';
				$html .= $formatted_content;
				$html .= '</a>';
			}
			
			$html .= '</li>';
			
		
		endwhile;
		
		$html .= '</ul>';
			
		$html .= '</div> <!-- end of announcement_post_group_list -->';

		wp_reset_postdata();

		return $html;
	}
	add_shortcode('show_category_list', 'get_announcement_list');
	
	
	function get_announcement ( $atts ) {
		
		extract( shortcode_atts( array(
			'type' => NULL,
			'program' => NULL,
			'number' => 99,
			'style' => '',
			'link' => 'title',
		), $atts ) );

		
		if ( !is_null($type) ) $type_pieces = explode(",", $type);
		if ( !is_null($program) ) $program_pieces = explode("," , $program);
		
		if ( !is_null($style) ) $style_options = explode( ",", $style);
		
		
		$categories = array();
		$program_id = array();

		if ( !is_null ( $type_pieces )  ) {
			foreach ( $type_pieces as $search_term ) {
				$term = get_term_by ('slug' , $search_term, 'announcement_type' );
				array_push( $categories , $term->term_id );
			}
		}
		
		if ( !is_null( $program_pieces ) ) {
			foreach ( $program_pieces as $search_program ) {
				$term = get_term_by ('slug' , $search_program, 'program_name' );
				array_push( $program_id , $term->term_id );
			}
			$tax_query_args = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'announcement_type',
					'field' => 'id',
					'terms' => $categories,
				),
				array(
					'taxonomy' => 'program_name',
					'field' => 'id',
					'terms' => $program_id,
				)
			);
		} else {
			$tax_query_args = array(
				array(
					'taxonomy' => 'announcement_type',
					'field' => 'id',
					'terms' => $categories,
				),
			);
		}
		
		$args = array(
			'post_type' => 'announcement',
			'orderby' => 'date',
			'order' => 'desc',
			'tax_query' => $tax_query_args,
			'posts_per_page' => $number,
		);
		$query_posts = new WP_Query( $args );		

		while ( $query_posts->have_posts() ) : $query_posts->the_post();
		
			$title = get_the_title();
			
			if ( in_array( 'excerpt', $style_options)) {
				$content = get_the_excerpt();
			} else {
				$content = get_the_content();
			}
			
			$formatted_content = apply_filters( 'the_content', $content );
			
			$author_url = bones_get_the_author_posts_link();
			$time1 = get_the_time('Y-m-j');
			$time2 = get_the_time('F jS, Y');
			$post_url = get_permalink();

			$html .= '<div class="announcement_post">';
			
				
			if (in_array('title', $style_options) ) $html .= '<h4>' . $title . '</h4>';
			if (in_array('time', $style_options)) $html .= '<time class="updated" datetime="' . $time1 . '" pubdate>' . $time2 . '</time>';
			if (in_array('author', $style_options)) $html .= ' by <span class="author">' . $author_url . '</span>';

			$html .= $formatted_content;
			
			
			$html .= '</div>';
			
		
		endwhile;

		wp_reset_postdata();

		return $html;
	}
	add_shortcode('show_category', 'get_announcement');
	
?>