<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">
		
		<script type="text/javascript">
			var templateDir = "<?php bloginfo('template_directory') ?>";
		</script>
						
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<!-- drop Google Analytics Here -->
		<!-- end analytics -->
		
		

	</head>

	<body <?php body_class(); ?>>
		
			<div id="container">

				<header class="top-header-bar" role="banner">

					<div id="top-bar-content" class="wrap clearfix">
						
						<ul id="top-bar-nav" class="left">

							<li><a href="<?php echo get_home_url(); ?>">Home</a></li>

							<?php if (is_user_logged_in()) : ?>
									<?php global $current_user; ?>
									<?php get_currentuserinfo(); ?>

									<li><a href="<?php echo $admin_link; ?>">Welcome, <?php echo ucfirst($current_user->display_name); ?></a></li>

									<li><a href="<?php echo $logoutlink; ?>" title="Logout">Logout</a></li>	

							<?php endif; ?>

						</ul>

						<?php
							$themeoption = get_option('optionsframework_bones');
							$twitter_url = $themeoption['twitterurl'];
							$facebook_url = $themeoption['facebookurl'];
							$youtube_url = $themeoption['youtubeurl'];
							$cart_url = get_permalink( $themeoption['shoppingcarturl'] );
						?>

						<ul id="top-bar-nav" class="right">

							<li><a href="<?php echo $twitter_url; ?>" target="_blank">Twitter</a></li>

							<li><a href="<?php echo $facebook_url; ?>" target="_blank">Facebook</a></li>

							<li><a href="<?php echo $youtube_url; ?>" target="_blank">Youtube</a></li>
							
							<li><a href="<?php echo $cart_url; ?>">Cart</a></li>
							<?php
							/*
							<li><a href="<?php echo $cart_url; ?>">Cart: <?php if(count($_SESSION['ultraSimpleCart']) == 0 ) { echo "0"; } else { echo count($_SESSION['ultraSimpleCart']); } ?> item(s)</a></li>
							*/
							?>
						</ul>

					</div> <!-- end of Top Bar Content -->

				</header> <!-- end of Top Header Bar -->

				<header class="header" role="banner">

					<div id="inner-header" class="wrap clearfix">

						<?php if ( !isset( $themeoption['headerlogo']) ) : ?>
						
							<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
							<div class="logo">
								<a href="<?php echo home_url(); ?>" rel="nofollow"><h1><?php bloginfo('name'); ?></h1></a>
							</div>	
							<!-- if you'd like to use the site description you can un-comment it below -->
							<?php // bloginfo('description'); ?>

						<?php else : ?>

							<div class="logo">
								<a href="<?php echo home_url(); ?>" rel="nofollow"><img id="logo" src="<?php echo $themeoption['headerlogo']; ?>" /></a>
							</div>
							
						<?php endif; ?>

						<nav role="navigation" class="header-top-right-nav">

							<?php top_header_menu(); ?>

						</nav>

						<div id="header-search">

							<?php get_search_form(); ?>

						</div>

						<div id="main-menu-half-left">

							<nav role="navigation">

								<?php bones_main_nav(); ?>

							</nav><!-- end of main-menu-half-left -->

						</div>

						<div id="main-menu-half-right">

							<nav role="navigation" class="main-right-nav">

								<?php bones_main_right_nav(); ?>

							</nav>

						</div> <!-- end of main-menu-half-right -->

					</div> <!-- end #inner-header -->

				</header> <!-- end header -->
			
				<div id="contain_footer_wrapper">
			