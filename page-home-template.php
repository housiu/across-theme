<?php
/*
Template Name: Homepage template
*/
?>
<?php 
	add_action( 'wp_enqueue_scripts', 'pp_jqueryui_accordion_function' );
	add_action( 'wp_enqueue_scripts', 'flexslider_js_script' ); 
	add_action( 'wp_enqueue_scripts', 'flexslider_js_style' ); 
	add_action( 'wp_enqueue_scripts', 'flexslider_activate' );
?>
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">
						<!-- <div id="main" class="eightcol first clearfix" role="main">-->
						<div id="main" class="first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<?php global $hp_mb,$slider_mb,$hp_mid_bot_section_mb; ?>
							<?php $meta = $hp_mb->the_meta(); ?>
							<?php $slider_meta = $slider_mb->the_meta(); ?>
							<?php $mid_bot_meta = $hp_mid_bot_section_mb->the_meta(); ?>

							<?php //print_r($meta); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<section class="entry-content clearfix" itemprop="articleBody">

									<div class="section-wrapper">

										<!--- Slider Section -->					
										<div class="flex-container">
											<div class="flexslider">
												<ul class="slides">
													<?php 
														foreach ( $slider_meta['slider_option_group'] as $slider ) {
															$slider_id = get_post_thumbnail_id( $slider['slider_option'] );
															$slider_img_url = wp_get_attachment_image_src( $slider_id , 'large' , true);
															
															echo '<li><a href="' . $slider['slider_url'] . '">';
															echo '<img src="' . $slider_img_url[0] . '"></a>';
															if ( isset( $slider['slider_caption'] ) ) {
																echo '<p class="flex-caption">'.$slider['slider_caption'].'</p>';
															}
															echo '</li>';
														}
													?>
												</ul>
											</div> <!-- end of flexslider -->
										</div> <!-- end of flex-container -->
										
										<!--- End of Slider Section -->

										<!--- Feature Accordion Section -->

										<div id="homepage-accordion" class="fourcol last">
											<h3><?php echo $meta['qf_group'][0]['top_qf_logo']; ?></h3>
											<div><?php echo $meta['qf_group'][0]['top_qf']; ?></div>

											<h3><?php echo $meta['qf_group'][0]['mid_qf_logo']; ?></h3>
											<div><?php echo $meta['qf_group'][0]['mid_qf']; ?></div>

											<h3><?php echo $meta['qf_group'][0]['bot_qf_logo']; ?></h3>
											<div><?php echo $meta['qf_group'][0]['bot_qf']; ?></div>
										</div>

										<!--- End Feature Accordion Section -->

									</div> <!-- End of div section-wrapper -->


									<div class="middle-section-wrapper">

										<!--- Beginning of Middle Section Large -->
										<div class="middle-left-large eightcol first">
											<?php 
												$content = "";
												$formatted_content = "";
												$content = $mid_bot_meta['md_group'][0]['md_l'];
												$formatted_content = apply_filters( 'the_content' , $content );
											?>
											<h2><?php echo $mid_bot_meta['md_group'][0]['md_l_logo']; ?></h2>
											<?php echo $formatted_content; ?>
											<!--- End of Middle Section Largen -->

										</div>

										<div class="middle-right-small fourcol last">

											<!--- Beginning of Middle Section Small -->
											<?php 
												$content = "";
												$formatted_content = "";
												$content = $mid_bot_meta['md_group'][0]['md_s'];
												$formatted_content = apply_filters( 'the_content' , $content );
											?>
											<h2><?php echo $mid_bot_meta['md_group'][0]['md_s_logo']; ?></h2>
											<?php echo $formatted_content; ?>
											<!--- End of Middle Section Small -->
										</div>

									</div> <!-- End of middle-section-wrapper -->

									<div class="bottom-section-wrapper">

										<div class="bottom-left fourcol first">

											<!--- Beginning of Bottom Section Left -->
											<?php 
												$content = "";
												$formatted_content = "";
												$content = $mid_bot_meta['bt_group'][0]['bt_l'];
												$formatted_content = apply_filters( 'the_content' , $content );
											?>
											<h2><?php echo $mid_bot_meta['bt_group'][0]['bt_l_logo']; ?></h2>
											<?php echo $formatted_content; ?>
											<!--- End of Bottom Section Left -->

										</div> <!-- end of bottom-left -->

										<div class="bottom-centre fourcol ">

											<!--- Beginning of Bottom Section Centre -->
											<?php 
												$content = "";
												$formatted_content = "";
												$content = $mid_bot_meta['bt_group'][0]['bt_c'];
												$formatted_content = apply_filters( 'the_content' , $content );
											?>
											<h2><?php echo $mid_bot_meta['bt_group'][0]['bt_c_logo']; ?></h2>
											<?php echo $formatted_content; ?>
											<!--- End of Bottom Section Centre -->

										</div> <!-- end of bottom-centre -->

										<div class="bottom-right fourcol">

											<!--- Beginning of Bottom Section Right -->
											<?php 
												$content = "";
												$formatted_content = "";
												$content = $mid_bot_meta['bt_group'][0]['bt_r'];
												$formatted_content = apply_filters( 'the_content' , $content );
											?>
											<h2><?php echo $mid_bot_meta['bt_group'][0]['bt_r_logo']; ?></h2>
											<?php echo $formatted_content; ?>
											<!--- End of Bottom Section Right -->

										</div> <!-- end of bottom-right -->

									</div> <!-- end of bottom-section-wrapper -->

									<?php //the_content(); ?>

								</section> <!-- end article section -->

								<footer class="article-footer">
									<?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?>

								</footer> <!-- end article footer -->

								<?php //comments_template(); ?>

							</article> <!-- end article -->

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <!-- end #main -->

						<?php //get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
