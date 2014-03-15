<?php get_header(); ?>
<div id="container">
	<div id="content" class="home">	
		<header>
			<?php echo get_new_royalslider(1); ?>
		</header> <!-- end top-header -->
		
		<section class="snippets">
			
			<section class="buttons">
				<span class="buttons blog"><a href="../journey" class="icon-d_arrows">THE JOURNEY<div></div><small>OUR JOURNAL, STORIES, NEWS AND EVENTS</small></a></span>
				<span class="buttons shop"><a href="../shop" class="icon-d_basket">THE SHOP<div></div><small>PURCHASE A BEAUTIFUL TOOL FOR YOUR JOURNEY</small></a></span>
				<span class="buttons studio"><a href="../studio" class="icon-d_man">THE STUDIO<div></div><small>AN INSIGHT INTO WHO WE ARE AND HOW WE WORK</small></a></span>
			</section>		
			
		</section> <!-- end snippets -->

		<!-- CHANGE CLASS TO shop-slide IF WE NEED TO CHANGE BACK TO DYNAMIC SLIDER -->
		<section class="screen" style="max-width:850px;">
			<?php echo get_new_royalslider(2); ?>
			<!--<div class="royalSlider rsDefaultBlack">
				<?php get_template_part( 'shop-featured-slider' ); ?>
			</div>-->
		</section>

		<footer id="extra">
			<?php twitterFeed(1); ?>
			<div class="insta_div">
				<?php
						 $temp = $wp_query;
						 $wp_query= null;
						 $wp_query = new WP_Query();
						 $tag = 'instagram';
						 $wp_query->query('posts_per_page=1&tag=-'.$tag.'&author=-1');
						 while( $wp_query->have_posts() ) : $wp_query->the_post();
					?>
					<a href="<?php echo get_the_content(); ?>"><?php echo the_post_thumbnail('medium'); ?></a>
				<?php endwhile; ?>
				<?php $wp_query = null; $wp_query = $temp;?>

			</div>
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
