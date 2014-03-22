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
			<!--<nav class="menu">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'wrap' ) ); ?>
			</nav>-->
			<nav class="menu">
			<ul id="menu-top-bar" class="wrap"><li id="menu-item-270" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-270"><a href="http://ajoto.com/shop/">Shop</a>
			<ul class="sub-menu">
				<li id="menu-item-2965" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2965"><a href="http://ajoto.com/shop/#pen">The Pen</a></li>
				<li id="menu-item-2966" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2966"><a href="http://ajoto.com/shop/#pouch">The Pouch</a></li>
				<li id="menu-item-2967" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2967"><a href="http://ajoto.com/shop/#wallet">The Wallet</a></li>
			</ul>
			</li>
			<li id="menu-item-3541" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-3541"><a href="http://dev.ajoto.com/products/the-pen/">Products</a>
			<ul class="sub-menu">
				<li id="menu-item-114" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-114"><a href="http://dev.ajoto.com/products/the-pen/">The Pen</a></li>
				<li id="menu-item-113" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-113"><a href="http://dev.ajoto.com/products/the-pen-pouch/">The Pen Pouch</a></li>
				<li id="menu-item-283" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-283"><a href="http://dev.ajoto.com/products/the-wallet/">The Wallet</a></li>
			</ul>
			</li>
			<li id="menu-item-116" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-116"><a href="http://dev.ajoto.com/journey/">Journey</a></li>
			<li id="menu-item-115" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-115"><a href="http://dev.ajoto.com/studio/">About</a>
			<ul class="sub-menu">
				<li id="menu-item-4473" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4473"><a href="http://dev.ajoto.com/studio/">Studio</a></li>
				<li id="menu-item-4472" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4472"><a href="http://dev.ajoto.com/team/">Team</a></li>
			</ul>
			</li>
			<li id="menu-item-2792" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2792"><a href="http://dev.ajoto.com/customer-service/">Service</a></li>
			</ul>
			</nav>
		</header> <!-- end header -->
