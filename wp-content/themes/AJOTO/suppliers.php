<?php
	/*
	Template Name: Suppliers
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
				<a class="current" href="../suppliers">SUPPLIERS</a>
				<a href="../stockists">STOCKISTS</a>
			</div>
		</section>

		<section class="title">
			<p>SUPPLIERS<span>COMING SOON</span></p>
		</section>
		
		<div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'first', true)); ?></div>

		<section class="title mid" id="pen">
			<p>COMING SOON<span>We are currently building an area dedicated to our suppliers, giving you an insight into manufacturers we work with along with services they provide. The new suppliers pages will be online in the coming months, but for now take a look at the <a href="../category/journal">Journal</a> section of the site to get a behind the scenes look at the development of our products.</span></p>
		</section>
		<div class="end"></div>
</div>
<?php get_footer(); ?>