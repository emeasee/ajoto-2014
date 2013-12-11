<?php get_header(); ?>
<div id="container">
	<div id="content" class="home">	
		<header style="margin-bottom:30px;">
			<?php echo get_new_royalslider(1); ?>
		</header> <!-- end top-header -->
		
		<section class="title">
			<p class="serif">We Create Beautiful Tools For Everyday Journeys</br>
			<span class="sans-serif">THOUGHTFULLY COMBINING THE PRECISION OF ADVANCED MANUFACTURE WITH THE SOUL OF CRAFT</span></p>
		</section>
		
		<!-- CHANGE CLASS TO shop-slide IF WE NEED TO CHANGE BACK TO DYNAMIC SLIDER -->
		<section class="screen" style="max-width:850px;">
			<?php echo get_new_royalslider(2); ?>
			<!--<div class="royalSlider rsDefaultBlack">
				<?php get_template_part( 'shop-featured-slider' ); ?>
			</div>-->
		</section>
		
		<section class="snippets">
			
			<div id="product-slide"><?php echo get_new_royalslider(3); ?></div>
			<section class="buttons serif">
				<span class="buttons studio"><a href="../studio" class="sans-serif"></a><a class="over" href="../studio"></a></span>
				<span class="buttons blog"><a href="../journeys" class="sans-serif"></a><a class="over" href="../journeys"></a></span>
			</section>		
			
		</section> <!-- end snippets -->

		<footer id="extra">
			<?php twitterFeed(1); ?>
			<div id="subscribe">
				<!-- Begin MailChimp Signup Form -->
					<div id="mc_embed_signup">
						<form action="http://ajoto.us5.list-manage.com/subscribe/post?u=c82a34182bb2b289759e01e9d&amp;id=5a90c4dc9a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
						<p>BE THE FIRST TO HEAR ABOUT PRODUCT LAUNCHES, SPECIAL EVENTS AND OFFERS</p>
						<div class="mc-field-group">
							<input type="email" placeholder="Enter email address" value="" name="EMAIL" class="required email" id="mce-EMAIL">
						</div>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>	
						<input type="submit" value="ENTER" name="subscribe" id="mc-embedded-subscribe" class="button">
						</form>
					</div>
					<!--End mc_embed_signup-->
			</div>
		</footer>
	</div>
</div>

<?php get_footer(); ?>
