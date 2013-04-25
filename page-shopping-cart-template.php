<?php
/*
Template Name: Shopping Cart Template
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="ninecol last clearfix" role="main">
<?php
/*
[ultraSimpleCart] => Array ( 
[0] => Array ( [name] => Event Recurring 1 - 16/04/2013 [price] => 3 [quantity] => 1 [shipping] => [cartLink] => http://dev.centurybookstore.com/events/event-recurring-1-2013-04-16/ [item_number] => )
[1] => Array ( [name] => Event Recurring 1 - 21/05/2013 [price] => 3 [quantity] => 1 [shipping] => [cartLink] => http://dev.centurybookstore.com/events/event-recurring-1-2013-05-21/ [item_number] => ) 
[2] => Array ( [name] => Event Recurring 1 - 23/04/2013 [price] => 3 [quantity] => 1 [shipping] => [cartLink] => http://dev.centurybookstore.com/events/event-recurring-1-2013-04-23/ [item_number] => ) )
*/

//echo EM_Events::output(array( 'post_id' => $_SESSION['ultraSimpleCart'][0]['eventid'] ));

?>
<?php /*
if ( !empty($_SESSION['ultraSimpleCart']) ) {
	foreach ( $_SESSION['ultraSimpleCart'] as $event ) {
		$event_names .= $event['name'] . ', ';
	}
	echo $event_names;
}
*/
?>
<?php //print_r($_SESSION); ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php
										printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(__('F jS, Y', 'bonestheme')), bones_get_the_author_posts_link());
									?></p>


								</header> <!-- end article header -->

								<section class="entry-content">
									<?php the_content(); ?>
								</section> <!-- end article section -->

								<footer class="article-footer">
									<p class="clearfix"><?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?></p>

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

registered_events
								<?php
									
									add_filter('gform_field_value_registered_events', 'serialize_event_id_function');
									function serialize_event_id_function($value){
										foreach ( $value as $v ) {

										}
										return 'boom!';
									}
								?>
							<?php endif; ?>

						</div> <!-- end #main -->

						<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
