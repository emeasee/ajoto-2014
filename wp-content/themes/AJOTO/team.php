<?php
	/*
	Template Name: Team Page
	*/
 ?>
<?php get_header(); ?>
<div id="content" class="about">
		<!--<section class="title small">
			<p>ABOUT<span>REVEALING THE INNER WORKINGS OF AJOTO</span></p>
		</section>
		<section class="filter">
			<div class="links">
				<a href="../studio">STUDIO</a>
				<a class="current" href="../team">TEAM</a>
				<a href="../suppliers">SUPPLIERS</a>
				<a href="../stockists">STOCKISTS</a>
			</div>
		</section>-->

		<section class="title subhead">
			<p>TEAM<span>WHO WE ARE AND THE PEOPLE WE WORK WITH</span></p>
		</section>
		
		<div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'first', true)); ?></div>

		<section class="title mid" id="pen">
			<p>CHRIS HOLDEN & TIM HIGGINS<span>Co-Founders Chris Holden and Tim Higgins are both established designers and have worked internationally as design consultants for some of the worlds most prestigious companies.
			<br><br>They First met in 2005 while studying Industrial Design at Northumbria University, in Newcastle. Having both lived and worked in Hong Kong and London they decided to combine their skills and established AJOTO in the Spring of 2011.
			<br><br>Their meticulous attention to detail can be seen throughout every stage of design and production, from sourcing specialist materials to pushing manufacturing processes.</span></p>
		</section>
	
	<section class="screen sans-serif">
		<div class="g two grey image">
			<img src="http://dev.ajoto.com/wp-content/uploads/2014/03/2014-03-22-studio-mac-2-low.jpg" />
		</div>
		<div class="g two grey">
			<p><span>MAC OOSTHUIZEN</span><br>Mac studied with founders Chris and Tim at Northumbria University, also travelling to Hong Kong and London to pursue various internships. His path lead him to the Copenhagen Institute of Interaction Design, during which time he was able to indulge in a passion for user experience and a fascination with new cultures.<br>
			<br/>In 2012 Mac joined the AJOTO team to run the digital side of the company. He currently splits his time between Paris and London.
			</p>	
		</div>
	</section>

	<section class="title mid" id="pen">
		<p>OUR EXTENDED NETWORK<span>People form the core of our company; from the individual customers who share our passion for great products to the specialists we work with who simply love what they do. We work closely with our suppliers, building lasting relationships based on a mutual respect for the skills we each bring to the design process.</span></p>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'last', true)); ?></div>
	<div class="end"></div>
</div>
<?php get_footer(); ?>