<?php
	/*
	Template Name: The Wallet
	*/
 ?>
<?php get_header(); ?>
<div id="container">

<div id="content" class="page">
		<header>
			<?php echo get_new_royalslider(29); ?>
		</header>
	
		<section class="title">
			<p class="serif">The Wallet</br>
			<span class="sans-serif">DETAILS, SPECIFICATION & FEATURES</span></p>
		</section>

		<section class="mid sans-serif">
			<div class="titles center product">
				<p class="icns wallicn">We wanted to celebrate the humble wallet, a simple tool that holds the keys to your world. Hand crafted from the finest Italian leather, it's a trustworthy companion to carry with you every day.</p>
				<span>FOR THE JOURNEY</span>
			</div>
			
		</section>

		<section class="screen">
			<div class="video">
				<span class="loading"><img class="cover" src="<?php echo home_url(); ?>/wp-content/uploads/2013/08/Making_Wallet.jpg"></span>
				<iframe id="player_6" src='http://player.vimeo.com/video/68225024?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;api=1&amp;player_id=player_6' width='850' height='479' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>
		</section>
		
	<div class="slideshow"><?php echo get_new_royalslider(30); ?></div>

	<section class="screen sans-serif">
		<div class="card cube quote">
			<a class="serif" href="../../shop/#wallet">Every Wallet £70
			<span class="sans-serif">CLICK HERE TO SHOP</span></a>
		</div>
		<div class="card three grey">
			<p><i>Every Wallet is handmade in Manchester using the finest vegetable tanned Italian leather. Over time the rich colours of the leather will increase in depth and tone.
				<span class="sans-serif">USE THE MAP BELOW TO FIND OUT MORE ABOUT WHO WE WORK WITH</span>
			</i></p>
		</div>
	</section>
	
	<div class="map">
		<?php build_map('wallet'); ?>
	</div>

	<div class="slideshow"><?php echo get_new_royalslider(31); ?></div>
	

	<section class="screen sans-serif">
		<div class="video small">
			<span class="loading"><img class="cover" src="<?php echo home_url(); ?>/wp-content/uploads/2013/08/Using-your-Wallet.jpg"></span>
			<iframe id="player_7" src='http://player.vimeo.com/video/73522882?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;api=1&amp;player_id=player_7' width='635' height='420' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div>
		<div class="card quart grey tall">
			<span class="grey top"></span>
			<p class="no-images"><i>Everytime you remove your Wallet from a pocket or bag you want to know that not only are your contents safe but that you hold a beautiful product that reflects your values.
<br/><br/>By carefully considering every detail we created a simple and honest wallet that's both versatile and slim.</i></p>
			<span class="grey bottom"></span>
		</div>
	</section>
		
	<section class="screen">
				<div class="card three grey">
			<p><i>Material king, simple, minimal beautiful. Carefully split to give a contrast of grain and colour. Each Wallet is expertly stitched and edge painted with matching thread.
				<span class="sans-serif">CLICK THROUGH THE IMAGES BELOW TO SEE THE PEN</span>
			</i></p>
		</div>

		<div class="card cube quote">
			<a class="serif" href="../../shop/#wallet">Every Wallet £70
			<span class="sans-serif">CLICK HERE TO SHOP</span></a>
		</div>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(32); ?></div>

	<section class="screen sans-serif">
		<div class="card quart black tall">
			<span class="top"></span>
			<span class="middle pen"></span>
			<p class="with-images"><i>However you use your Wallet we know you will enjoy every moment and we hope you share your story with us.</i></p>
			<span>#AJOTOWALLET</span>
			<span class="share">
				<a href="http://www.facebook.com/ajotostudio" class="fb"></a>
				<a href="http://www.twitter.com/ajoto" class="tw"></a>
				<a href="http://www.pinterest.com/ajoto" class="pn"></a>
			</span>
			<span class="bottom"></span>
		</div>
		<div class="slideshow small" id="name">
			<?php echo get_new_royalslider(33); ?>
		</div>
	</section>
	
	<footer class="break"></footer>

	</div>
</div>
<?php get_footer(); ?>