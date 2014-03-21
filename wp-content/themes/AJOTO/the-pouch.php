<?php
	/*
	Template Name: The Pouch
	*/
 ?>
<?php get_header(); ?>
<div id="content" class="page">
		<section class="title small">
			<p>PRODUCTS<span>A SHORT 140 CHARACTER BLURB TO INTRODUCE THE PAGE BEING VIEWED</span></p>
		</section>
		<section class="filter">
			<div class="links">
				<a href="../pen">THE PEN</a>
				<a class="current" href="../pen-pouch">THE PEN POUCH</a>
				<a href="../wallet">THE WALLET</a>
			</div>
		</section>

		<section class="title mid">
			<p>THE PEN POUCH<span>DETAILS, SPECIFICATION & FEATURES</span></p>
		</section>

		<section class="mid sans-serif">
			<div class="titles center product">
				<p class="icns pouchicn">The Pouch is a beautifully simple way to store and protect your Pen. A combination of expert craftsmanship and the finest Italian leather it will be your Pen's perfect companion for a lifetime.</p>
				<span>MAKE YOUR MARK</span>
			</div>
			
		</section>

		<section class="screen">
			<div class="video">
				<span class="loading"><img class="cover" src="<?php echo home_url(); ?>/wp-content/uploads/2013/08/Making_Pouch.jpg"></span>
				<iframe id="player_6" src='http://player.vimeo.com/video/68225024?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;api=1&amp;player_id=player_6' width='850' height='479' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>
		</section>

	<section class="screen sans-serif">
		<div class="card cube quote">
			<a href="../../shop/#pouch">Every Pouch £35
			<span class="sans-serif">CLICK HERE TO SHOP</span></a>
		</div>
		<div class="card three grey">
			<p><i>Every pouch is handmade in Manchester using the finest vegetable tanned Italian leather. Over time the rich colours of the leather will increase in depth and naturally soften, molding perfectly around your Pen.
				<span class="sans-serif">USE THE MAP BELOW TO FIND OUT MORE ABOUT WHO WE WORK WITH</span>
			</i></p>
		</div>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(21); ?></div>

	<section class="screen sans-serif">
		<div class="video small">
			<span class="loading"><img class="cover" src="<?php echo home_url(); ?>/wp-content/uploads/2013/08/Using-your-Pouch.jpg"></span>
			<iframe id="player_7" src='http://player.vimeo.com/video/73523946?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;api=1&amp;player_id=player_7' width='635' height='420' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div>
		<div class="card quart grey tall">
			<span class="grey top"></span>
			<p class="no-images"><i>It was important to us that the pouch was as beautifully considered as the pen itself.
			<br/><br/>The leather’s strength is increased through a splitting process, edges are then sealed with the natural oil of Indian Teak wood before being hand painted.</i></p>
			<span class="grey bottom"></span>
		</div>
	</section>
		
	<section class="screen">
				<div class="card three grey">
			<p><i>Celebrating the purity and quality of the naturally tanned leather we carefully split each hide to the perfect thickness then expertly stitch each piece together to create a strong yet supple Pen Pouch.
				<span class="sans-serif">CLICK THROUGH THE IMAGES BELOW TO SEE THE PEN</span>
			</i></p>
		</div>

		<div class="card cube quote">
			<a href="../../shop/#pouch">Every Pouch £35
			<span class="sans-serif">CLICK HERE TO SHOP</span></a>
		</div>
	</section>

	<div class="slideshow"><?php echo get_new_royalslider(26); ?></div>

	<section class="screen sans-serif">
		<div class="card quart black tall">
			<span class="top"></span>
			<span class="middle pen"></span>
			<p class="with-images"><i>However you use your Pouch we know you will enjoy every moment and we hope you share your story with us.</i></p>
			<span>#AJOTOPOUCH</span>
			<span class="share">
				<a href="http://www.facebook.com/ajotostudio" class="fb"></a>
				<a href="http://www.twitter.com/ajoto" class="tw"></a>
				<a href="http://www.pinterest.com/ajoto" class="pn"></a>
			</span>
			<span class="bottom"></span>
		</div>
		<div class="slideshow small" id="name">
			<?php echo get_new_royalslider(27); ?>
		</div>
	</section>
	
	<footer class="break"></footer>

</div>
<?php get_footer(); ?>