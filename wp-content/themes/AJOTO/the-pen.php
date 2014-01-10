<?php
	/*
	Template Name: The Pen
	*/
 ?>
<?php get_header(); ?>
<div id="container">

<div id="content" class="page">
		<header>
			<?php echo get_new_royalslider(15); ?>
		</header>
	
		<section class="title">
			<p class="serif">The Pen</br>
			<span class="sans-serif">DETAILS, SPECIFICATION & FEATURES</span></p>
		</section>

	<section class="mid sans-serif">
		<div class="titles center product">
			<p class="icns penicn">We wanted to do justice to the most important tool we use everyday. That's why we created a pen that not only has a great story but marks the beginning of a journey that will last a lifetime.</p>
			<span>MAKE YOUR MARK</span>
		</div>
		
	</section>

	<section class="screen">
		<div class="video">
			<span class="loading"><img class="cover" src="<?php echo home_url(); ?>/wp-content/uploads/2013/08/Making_Pen1.jpg"></span>
			<iframe id="player_3" src='http://player.vimeo.com/video/68227510?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;api=1&amp;player_id=player_3' width='850' height='478' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(16); ?></div>
	
	<section class="title small">
		<p class="sans-serif">FEATURES</br>
	</section>
	
	<section class="screen sans-serif">
		<div class="card cube quote">
			<a class="serif" href="../../shop/the-pen">Starting from £126
			<span class="sans-serif">CLICK HERE TO SHOP</span></a>
		</div>
		<div class="card three grey">
			<p><i>Each component of The Pen is manufactured to the highest standards in the UK, Germany and Portugal. From the farmer who hand strips cork bark to the engineer who meticulously programmes each CNC machine, it is their combined knowledge and passion that makes The Pen unique.
				<span class="sans-serif">USE THE MAP BELOW TO FIND OUT MORE ABOUT WHO WE WORK WITH</span>
			</i></p>
		</div>
	</section>

	<div class="map">
		<div class="key"><p class="left">UK MANUFACTURERS</p><p class="right">EUROPEAN MANUFACTURERS</p></div>
		<?php //build_map('pen'); ?>
	</div>

	<div class="slideshow"><?php echo get_new_royalslider(17); ?></div>

		
	<section class="screen">
		<div class="video small">
			<span class="loading"><img class="cover" src="<?php echo home_url(); ?>/wp-content/uploads/2013/08/Using_Pen.jpg"></span>
			<iframe id="player_2" src='http://player.vimeo.com/video/53888931?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;api=1&amp;player_id=player_2' width='635' height='420' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div>
		<div class="card quart grey tall">
			<p class="no-images"><i>We set out to create the only Pen you'll ever need. Minimising complexity and focusing on quality, each of the Pen's seven key components has a unique purpose. 
			<br/><br/>The elegant modular design allows you to control the look and feel of your Pen.
			<br/><br/>However you use your pen we know you'll enjoy every moment and we hope you share your story with us.</i></p>
			<span class="top gold"></span>
		</div>
		<div class="card three grey">
			<p><i>Designed to age gracefully, each pen is carefully crafted so that however you navigate your world your Pen is a true reflection of your experiences.
				<span class="sans-serif">CLICK THROUGH THE IMAGES BELOW TO SEE THE PEN</span>
			</i></p>
		</div>
		<div class="card cube quote">
			<a class="serif" href="../../shop/the-pen">Starting from £126
			<span class="sans-serif">CLICK HERE TO SHOP</span></a>
		</div>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(18); ?></div>

	<section class="screen sans-serif">
		<div class="card quart grey tall">
			<p class="no-images"><i>A Pen is only as good as the quality of the ink it uses. We work with one of the world’s finest refill manufacturers based in Germany to ensure our ink is of the highest standard.<br/><br/>
Offered in a Liquid Ink Rollerball and a Fine Ballpoint, each refill is perfectly suited to your Pen.</i></p>
			<span class="top gold"></span>
		</div>
		<div class="slideshow small" id="name">
			<?php echo get_new_royalslider(47); ?>
		</div>
	</section>

	<section class="screen sans-serif">
		<div class="card quart black tall">
			<span class="top"></span>
			<span class="middle pen"></span>
			<p class="with-images"><i>However you use your Pen we know you will enjoy every moment and we hope you share your story with us.</i></p>
			<span>#AJOTOPEN</span>
			<span class="share">
				<a href="http://www.facebook.com/ajotostudio" class="fb"></a>
				<a href="http://www.twitter.com/ajoto" class="tw"></a>
				<a href="http://www.pinterest.com/ajoto" class="pn"></a>
			</span>
			<span class="bottom"></span>
		</div>
		<div class="slideshow small" id="name">
			<?php echo get_new_royalslider(19); ?>
		</div>
	</section>
	
	<footer class="break"></footer>

	</div>
</div>
<?php get_footer(); ?>