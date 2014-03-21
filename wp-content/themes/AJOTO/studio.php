<?php
	/*
	Template Name: Studio Page
	*/
 ?>
<?php get_header(); ?>
<div id="content" class="about">
		<section class="title small">
			<p>ABOUT<span>A SHORT 140 CHARACTER BLURB TO INTRODUCE THE PAGE BEING VIEWED</span></p>
		</section>
		<section class="filter">
			<div class="links">
				<a class="current" href="../studio">STUDIO</a>
				<a href="../team">TEAM</a>
				<a href="../suppliers">SUPPLIERS</a>
				<a href="../stockists">STOCKISTS</a>
			</div>
		</section>

		<section class="title">
			<p>STUDIO<span>THIS IS WHERE THE 140 CHARACTER EXCERPT FROM THE POST APPEARS.</span></p>
		</section>
		
		<div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'first', true)); ?></div>

		<section class="title mid" id="pen">
			<p>WHO WE ARE<span>At AJOTO we create beautiful tools for everyday journeys, combining the precision of advanced manufacture with the soul of craft. Inspired by modern nomadic ideals, our products form a collection of essential items which embrace the spirt of travel.<br><br>
			Established in 2011 by designers Chris Holden and Tim Higgins, AJOTO was founded upon a vision where the journey of production was just as important as the destination. Based in the heart of London we take time to develop our ideas and seek out manufacturing specialists who share our values. By collaborating closely with them, we develop elegant and affordable products which can be used everyday and treasured for a lifetime.</span></p>
		</section>
	
	<section class="screen sans-serif">
		<div class="g two grey image">
			
		</div>
		<div class="g two grey image">
			
		</div>
		<div class="g three grey">
			<span>BRAND JOURNEY</span><p>AJOTO believe in great design. From the hidden patterns and symbols inside the packaging to the patina of materials, each of the ‘Beautiful Tools’ AJOTO create reveal more depth the more they are used.</p>
		</div>
		<div class="g three grey">
			<span>PRODUCTION JOURNEY</span><p>Working closely with the finest manufacturers in the UK and Europe, we celebrate the people, places and processes involved in the making of every product.</p>
		</div>
		<div class="g three grey">
			<span>YOUR JOURNEY</span><p>AJOTO products are tools designed to be used and enjoyed on ‘Your Journey’. Whether it’s a daily commute or an adventure into the unknown, the world is full of opportunities waiting to be discovered.</p>
		</div>

	</section>

	<section class="title mid" id="pen">
		<p>ENVIRONMENTAL RESPONSIBILITY<span>It is our responsibility as designers and manufacturers to think harder about reducing waste and eradicating the use of harmful chemicals from everything we do. We have worked hard to use materials which are recyclable and can be traced to their sources. Of equal importance is the quality of our products. Manufactured to the highest industry standards ensures that wherever you go and whatever you do they will last a lifetime.<br><br>
		We have done our best in being open and transparent throughout our supply chain in order to minimise our impact on the environment. If there are any areas you feel we can improve feel free to get in touch.</span></p>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'last', true)); ?></div>
	
</div>
<?php get_footer(); ?>