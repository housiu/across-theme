<?php
/*
Template Name: Program Page Template
*/
?>
<?php 
	add_action( 'wp_enqueue_scripts', 'pp_jqueryui_tabs_function' ); 
	add_action( 'wp_enqueue_scripts' , 'highslide_activate' );
?>

<?php get_header(); ?>

	<div id="content">

		<div id="inner-content" class="wrap clearfix">

				<div id="main" class="twelvecol first clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
												
					<?php global $pp_mb; ?>
					<?php global $pp_gallery; ?>

					<?php $meta = $pp_mb->the_meta(); ?>
					
					<?php //print_r($meta); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
					
						<?php if ( !empty($meta['general_page_group']) ) : ?>
							
							<div id="tabs">
							
								<section class="pp_tabs threecol first">
								
									<header class="article-header ">

										<h1 class="page-title"><?php the_title(); ?></h1>
			
									</header> <!-- end article header -->
								
									<ul>
									<?php 
										/* Tabs Creation */
										$x=1;
										$content_array = array();
										$title_array = array();
										foreach ( $meta['general_page_group'] as $tab ) {
											$tab_id = $tab['gen_page'];
											$post = get_post($tab_id);
											$title = $post->post_title;
											array_push( $content_array , $post->post_content );
											array_push( $title_array, $post->post_title );
											echo '<li><a href="#tabs-' . $x . '">' . $title . '</a></li>';
											$x++;
										}

										if ( !empty($meta['pp_flickr_set_group']) ) {
											echo '<li><a href="#tabs-' . $x . '">Gallery</a></li>';
											$x++;
										}
										
									?>
									</ul>
									
									<?php get_sidebar('pp_sidebar'); ?>
									
								</section>
								
								<section class="pp_content ninecol last">
								
									<?php
										// Begin Customizable Tabs
										$x=1;
										$y=0;
										//print_r($content_array);
										foreach ( $content_array as $content ) {
											echo '<div id="tabs-' . $x . '">';
											echo '<h2>' . $title_array[$y] . '</h2>';
											$formatted_content = apply_filters( 'the_content' , $content );
											echo do_shortcode($formatted_content);
											echo '</div>';
											$x++;
											$y++;
										} 
										// End of Customizable Tabs
										

										// Begin of Gallery Tab
										if (!empty($meta['pp_flickr_set_group'])) {
											//print_r($meta['pp_flickr_set_group']);
											echo '<div id="tabs-' . $x . '">';
											echo '<h2>Gallery</h2>';
											if ( count( $meta['pp_flickr_set_group'] ) > 1 ) {
												//show in a list with less pictures per set
												foreach ( $meta['pp_flickr_set_group'] as $gallery_post ) {
													$gallery_post_id = $gallery_post['pp_flickr_set'];
													$gallery_post_data = get_post( $gallery_post_id );
													$gallery_title = $gallery_post_data->post_title;
													$gallery_meta = get_post_meta( $gallery_post_data->ID, $pp_gallery->get_the_id(), TRUE);
													echo $gallery_title;
													echo get_flickr_photo( $gallery_meta['pp_flickr_set'] , 10 , false, '');
												}
											} else {
												//show Set in a full page
												$gallery_id = $meta['pp_flickr_set_group'][0]['pp_flickr_set'];
												$gallery_post = get_post( $gallery_id );
												$gallery_title = $gallery_post->post_title;
												$gallery_meta = get_post_meta( $gallery_post->ID, $pp_gallery->get_the_id(), TRUE);
												echo $gallery_title;
												echo get_flickr_photo( $gallery_meta['pp_flickr_set'] , 30 , false, '');
											}
											echo '</div>';
										}
										$x++;

										// End of Gallery Tab
									?>
								
								
							</section>
							
						</div> <!-- end of tabs -->
						
						<?php endif; ?>
						
						
						
						<section class="entry-content ninecol last">
							<?php the_content(); ?>
						</section> <!-- end article section -->

						<footer class="article-footer twelvecol first">
							<p class="clearfix"><?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?></p>
							<p class="byline vcard last"><?php
								printf(__('Last Updated <time class="updated" datetime="%1$s" pubdate>%2$s</time>.', 'bonestheme'), get_the_modified_date('Y-m-j'), get_the_time(__('F jS, Y', 'bonestheme')), bones_get_the_author_posts_link());
							?></p>

						</footer> <!-- end article footer -->

						<?php comments_template(); ?>

					</article> <!-- end article -->

					<?php endwhile; ?>

					<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
								</header>
									<section class="entry-content">
										<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
								</section>
								<footer class="article-footer">
										<p><?php _e("This is the error message in the page-custom.php template.", "bonestheme"); ?></p>
								</footer>
							</article>

					<?php endif; ?>

				</div> <!-- end #main -->


		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
