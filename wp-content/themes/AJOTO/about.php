<?php
	/*
	Template Name: About Page
	*/
 ?>
<?php get_header(); ?>
<div id="container">

<div id="content" class="about">
		<section class="title small">
			<p>ABOUT<span>A SHORT 140 CHARACTER BLURB TO INTRODUCE THE PAGE BEING VIEWED</span></p>
		</section>
		<section class="filter">
			<div class="links">
				<a class="current" href="../../journal">ALL</a>
			</div>
		</section>

		<section class="title">
			<p>STUDIO<span>THIS IS WHERE THE 140 CHARACTER EXCERPT FROM THE POST APPEARS.</span></p>
		</section>
		
	<section class="mid frame">
					<div class="pickout"><h1>Through a careful balance of functionality, aesthetic and longevity we take our time to create elegant products which enrich your 
daily life.</h1></div>	
				<div class="titles threecol">
					<h4>At AJOTO we create beautiful tools for everyday journeys, combining the precision of advanced manufacture with the soul of craft. Inspired by modern nomadic ideals, our products form a collection of essential items which embrace the spirt of travel.
					<br/><br/>Established in 2011 by designers Chris Holden and Tim Higgins, AJOTO 	was founded upon a vision where the journey of production was just as important as the destination. Based	 in the heart of London we take time to develop our ideas and seek out manufacturing specialists who share our values. By collaborating closely with them, we develop elegant and affordable products which can be used everyday and treasured for a lifetime.
					<br/><br/>We firmly believe that the items we produce encourage and enhance a creatively curious lifestyle. This is why we share each of our product’s unique stories; revealing the people, processes and places involved in their manufacture.</h4>
				</div>	
	</section>
	
	<section class="screen sans-serif">
		<div class="card quart grey tall">
			<span class="top gold"></span>
			<span class="middle star"></span>
			<p class="with-images"><i>As a creative company we believe in the power of storytelling, which is why we meticulously considered our identity to ensure it honestly reflects our aspirations and values.</i></p>
			<span class="middle">STAY CURIOUS</span>
			<span class="bottom gold"></span>
		</div>
		<div class="slideshow small" id="name">
			<?php echo get_new_royalslider(8); ?>
		</div>
	</section>

	<section class="mid sans-serif">
		<div class="titles center"><p>As professional designers we have worked internationally for some of the worlds biggest brands. From our experience we know how important it is to have control over every element of a product in order to ensure its quality. From rough idea to final production we have overseen every part of the Pen’s development, sharing our journey with you every step of the way.</p></div>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(9); ?></div>
		
	<section class="screen">
		<div class="video small">
			<span class="loading"><img class="cover" src="<?php echo home_url(); ?>/wp-content/uploads/2013/08/blank-Play-button.jpg"></span>
			<iframe id="player_1" src='http://player.vimeo.com/video/53808352?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;api=1&amp;player_id=player_1' width='635' height='420' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div>
		<div class="card quart grey tall">
			<p class="no-images"><i>Our philosophy and process provide us with a framework for creative thinking and experimentation; allowing us to logically develop our ideas into solutions.
			<br/><br/>We created a short animation to give you an introduction to the way we work and think.</i></p>
			<span class="top grey"></span>
		</div>
		<div class="card half grey tall">
			<h1>ENVIRONMENTAL RESPONSIBILITY</h1>
			<p><i>It is our responsibility as designers and manufacturers to think harder about reducing waste and eradicating the use of harmful chemicals from everything we do. We have worked hard to use materials which are recyclable and can be traced to their sources. Of equal importance is the quality of our products. Manufactured to the highest industry standards ensures that wherever you go and whatever you do they will last a lifetime.<br/><br/>
			We have done our best in being open and transparent throughout our supply chain in order to minimise our impact on the environment. If there are any areas you feel we can improve feel free to get in touch.		
			</i></p>
		</div>
		<div class="card half image tall"><?php echo get_new_royalslider(46); ?></div>
	</section>

	<section class="mid sans-serif">
		<div class="titles center"><p class="studioicn">People form the core of our company; from the individual customers who share our passion for great products to the specialists we work with who simply love what they do. Below is an introduction to our studio based team who form a small part of a much bigger network of talented people.</p></div>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(10); ?></div>
	
	<footer class="break"></footer>

	</div>
</div>
<?php get_footer(); ?>