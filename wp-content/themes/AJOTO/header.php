<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?><?php wp_title('/'); ?></title>
	<meta name="viewport" content="width=device-width">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/apple-touch-icon.png">
	<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!--[if lt IE 8]>
	    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<![endif]-->
	<div id="container">
		<header role="banner" class="header">
			<div id="inner-header" class="wrap clearfix">			
				<p id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/ajoto-logo.png" alt=""/>BEAUTIFUL TOOLS FOR YOUR JOURNEY</a></p>			
			</div> <!-- end #inner-header -->
			<nav class="menu">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'wrap' ) ); ?>
			</nav>
		</header> <!-- end header -->
