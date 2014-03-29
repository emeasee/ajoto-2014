<?php
	/*
	Template Name: Stockists
	*/
 ?>
<?php get_header(); ?>
<div id="content" class="about">
		<section class="title small">
			<p>ABOUT<span>REVEALING THE INNER WORKINGS OF AJOTO</span></p>
		</section>
		<section class="filter">
			<div class="links">
				<a href="../studio">STUDIO</a>
				<a href="../team">TEAM</a>
				<a href="../suppliers">SUPPLIERS</a>
				<a class="current" href="../stockists">STOCKISTS</a>
			</div>
		</section>

		<section class="title">
			<p>STOCKISTS<span>COMING SOON</span></p>
		</section>
		
		<div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'first', true)); ?></div>

		<section class="title mid" id="pen">
			<p>COMING SOON<span>AJOTO products will soon be available from selected retailers, we are currently building a directory dedicated to our stockists. If you are retailer interested in stocking AJOTO please don’t hesitate to <a href="mailto:studio@ajoto.com">get in touch.</a> Alternately, head to our <a href="../shop">Shop</a> if you would like to make a purchase.</span></p>
		</section>
		<div class="end"></div>
</div>
<?php get_footer(); ?>