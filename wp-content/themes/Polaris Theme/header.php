

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">


		<!-- Link framework CSS files here -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/frameworks/normalize.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/frameworks/boilerplate.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/frameworks/bootstrap-3.3.7/css/bootstrap.min.css">

		<!-- Link all external fonts here -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700,900&subset=cyrillic,greek,vietnamese" rel="stylesheet">

		<!-- Link the main style.css here -->
		<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css"> -->

		<!-- Link additional CSS files here -->
		
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animations.css">


		<?php wp_head(); ?>

	</head>


	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header role="banner">

				<div class="header-background">

					<div class="container">

						<div class="row">

							<div class="header-logo-container col-xs-6 col-sm-4 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-3 ">
								<a href="<?php echo home_url(); ?>">
									<img class="header-logo vertical-center" src="<?php echo get_template_directory_uri(); ?>/assets/polaris_logo_white.png" alt="" />
								</a>
							</div>

							<!-- nav -->
							<nav class="header-nav-container col-xs-3 col-xs-offset-3 col-sm-8 col-sm-offset-0 col-md-6 col-md-offset-3" role="navigation">

								<?php html5blank_nav(); ?>

							</nav>
							<!-- /nav -->


						</div>

					</div>
				</div>



			</header>
			<!-- /header -->
