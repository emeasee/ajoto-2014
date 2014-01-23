<?php
	/*
	Template Name: Shop
	*/
 ?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="container">
		<div id="content" class="<?php echo $post->post_name; ?> products">
				<header>
					 <div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'first', true)); ?></div>
					</header>
					
					<section class="listings" style="margin-bottom:70px;">
						<h3 id="pen">The Pen</h3>
						<section class="mid sans-serif">
							<div class="titles center product">
								<p class="icns penicn">We wanted to do justice to the most important tool we use everyday. That's why we created a pen that not only has a great story but marks the beginning of a journey that will last a lifetime.<br/><br/>Each Pen comes wrapped in an anodised aluminium box with a molded cork tray.
									<br/><br/><a href="../products/the-pen" class="button more">Find out more</a>
								</p>
							</div>
							
						</section>
						<div id="pen"><?php echo do_shortcode( '[products skus="MYM001SP2,MYM001RAWP,MYM001BP2,MYM001BRP2"]' ); ?></div>

						<h3 id="refills">Refills</h3>
						<section class="mid sans-serif">
							<div class="titles center product">
								<p class="icns penicn">A Pen is only as good as the quality of the ink it uses. We work with one of the world's finest refill manufacturers based in Germany to ensure our ink is of the highest standards.
<br/><br/>We offer the liquid ink Rollerball refill which is smooth, rich and arguably the best refill in the world.
									<br/><br/><a href="../products/the-pen" class="button more">Find out more</a>
								</p>
							</div>
							
						</section>
						<div id="refills"><?php echo do_shortcode( '[products skus="MYM001RBB,3MYM001RBB"]' ); ?></div>

						<h3 id="pouch">Pen Pouch</h3>
						<section class="mid sans-serif">
							<div class="titles center product">
								<p class="icns penicn">The Pouch is a beautifully simple way to store and protect your Pen. A combination of expert crafttmanship and the finest Tuscan vegetable tanned leather, it will be your Pen's perfect companion for a lifetime.
									<br/><br/><a href="../products/the-pen-pouch" class="button more">Find out more</a>
								</p>
							</div>
							
						</section>
						<div id="pouch"><?php echo do_shortcode( '[products skus="MYM001PPLB2,MYM001PPB,MYM001PPDB,MYM001PPLB"]' ); ?></div>

						<h3 id="wallet">Wallet</h3>
						<section class="mid sans-serif">
							<div class="titles center product">
								<p class="icns penicn">Your Wallet is an essential tool which not only represents your values but holds the keys to your world. Re-imagining the bi-fold wallet, we've reduced fuss and focused on producing a slim modern wallet using the finest Tuscan leather which will become a trustworthy companion to carry with you everyday.
									<br/><br/><a href="../products/the-wallet" class="button more">Find out more</a>
								</p>
							</div>
							
						</section>
						<div id="wallet"><?php echo do_shortcode( '[products skus="FTJ001WB2,FTJ001WLB2,FTJ001WDB2"]' ); ?></div>

					</section> <!-- end article section -->												
					<?php endwhile; ?>									
	</div>
		<?php endif; ?>
</div>
<?php get_footer(); ?>