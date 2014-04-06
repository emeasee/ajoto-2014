<?php
	/*
	Template Name: The Pen
	*/
 ?>
<?php get_header(); ?>
<div id="content" class="page">
		<section class="title small">
			<p>PRODUCTS<span>ESSENTIAL DETAILS ABOUT EACH OF OUR BEAUTIFUL TOOLS</span></p>
		</section>
		<section class="filter">
			<div class="links">
				<a class="current" href="../the-pen">THE PEN</a>
				<a href="../the-pen-pouch">THE PEN POUCH</a>
				<a href="../the-wallet">THE WALLET</a>
			</div>
		</section>

		<section class="title mid">
			<p>THE PEN<span>DETAILS, SPECIFICATION & FEATURES</span></p>
		</section>

	<section class="screen">
		<div class="video">
			<span class="loading"><img class="cover" src="<?php echo home_url(); ?>/wp-content/uploads/2013/08/Making_Pen1.jpg"></span>
			<iframe id="player_3" src='http://player.vimeo.com/video/68227510?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;api=1&amp;player_id=player_3' width='850' height='478' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div>
	</section>
	
	<section class="screen sans-serif">
		<div class="card cube shop">
			<i class="icon-basket"></i>
			<a href="../shop/#pen">Starting from £126</a>
			<span class="sans-serif">CLICK HERE TO SHOP</span>
		</div>
		<div class="card three grey">
			<p><i>We wanted to do justice to the most important tool we use everyday. That's why we created a pen that not only has a great story but marks the beginning of a journey that will last a lifetime.
				<span class="sans-serif">CLICK THROUGH TO SEE MORE ABOUT THE PEN</span>
			</i></p>
		</div>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(16); ?></div>

		
	<section class="screen">
		<div class="video small">
			<span class="loading"><img class="cover" src="<?php echo home_url(); ?>/wp-content/uploads/2013/08/Using_Pen.jpg"></span>
			<iframe id="player_2" src='http://player.vimeo.com/video/53888931?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;api=1&amp;player_id=player_2' width='635' height='357' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div>
		<div class="card quart grey mid">
			<p class="no-images"><i>We set out to create the only Pen you'll ever need. minimising complexity and focusing on quality, each of the Pen's seven key components has a unique purpose.
			<br/><br/>At the heart of the Pen is the twist, a simple and decisive gesture that works so well you won’t want to put it down.</i></p>
			<span class="top gold"></span>
		</div>
	</section>
	
	<div class="slideshow"><?php echo get_new_royalslider(18); ?></div>

	<section class="screen">
		<div class="card cube shop">
			<i class="icon-basket"></i>
			<a href="../shop/#pen">Starting from £126</a>
			<span class="sans-serif">CLICK HERE TO SHOP</span>
		</div>
		<div class="card three grey">
			<p><i>Each component of The Pen is manufactured to the highest standards in the UK, Germany and Portugal. From the farmer who hand strips cork bark to the engineer who meticulously programmes each CNC machine, it is their combined knowledge and passion that makes The Pen unique.
				<span class="sans-serif">CLICK BELOW TO SEE MORE ON MANUFACTURE</span>
			</i></p>
		</div>
	</section>


	<section class="screen">
		<div class="slideshow small" id="name">
			<?php echo get_new_royalslider(19); ?>
		</div>
		<div class="card quart black mid">
			<i class="icon-clover"></i>
			<p>However you use your #AJOTO products we know you will enjoy every moment. <br/><br/>Share your story with us.</p>
			<a class="twitter" href="http://www.twitter.com/ajoto">@AJOTO</a>
			<span class="share">
				<a href="http://www.facebook.com/ajoto" class="icon-social_fb"></a>
				<a href="http://www.instagram.com/ajoto" class="icon-social_inst"></a>
				<a href="http://www.pinterest.com/ajoto" class="icon-social_pin"></a>
				<a href="http://www.twitter.com/ajoto" class="icon-social_twitter"></a>
			</span>
		</div>
	</section>
	
	<footer class="break"></footer>

</div>
<?php get_footer(); ?>