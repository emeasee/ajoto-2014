<?php
	/*
	Template Name: Blog
	*/
	?>
<?php get_header(); ?>
	<div id="container">
		<div id="content" class="blog">
		<header>
			<?php echo get_new_royalslider(11); ?>
		</header>
		<section class="title">
			<p class="serif">Sharing our journeys with you</br>
			<span class="sans-serif">WE REVEAL THE PEOPLE, PLACES AND EXPERIENCES THAT INSPIRE US TO DO WHAT WE DO</span></p>
		</section>
			<div id="inner-content" class="wrap clearfix">
				<div id="main" class="clearfix default" role="main">
					<?php 
						 $temp = $wp_query;
						 $wp_query= null;
						 $wp_query = new WP_Query(); 
						 $wp_query->query('posts_per_page=10&author=-1&paged='.$paged); 
						 while( $wp_query->have_posts() ) : $wp_query->the_post();
						 $num++;
					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix, threecol, transition'); ?> role="article">
							<section class="clearfix hover" rel="<?php the_permalink() ?>">
								<?php the_post_thumbnail( 'AJOTO-Thumb' ); ?>						
							</section> <!-- end article section -->
							
							<footer class="post-title" style="cursor:pointer;">
							<?php if (MobileDTS::is('mobile') && !MobileDTS::is('ipad')){ ?>
							<span class="mobile">
								<div class="h2">
								
								<?php if (strlen($post->post_title) > 70) {
								echo substr(the_title($before = '', $after = '', FALSE), 0, 70) . '...'; } else {
								the_title();
								} ?>
									<span class="serif" style="display:block;"><p class="excerpt"><?php echo get_the_excerpt(); ?></p><a class="readmore" href="<?php the_permalink() ?>">Read More...</a></span>
								</div>
							</span>
							<?php } else { ?>
							<a href="<?php the_permalink() ?>">
								<div class="h2">
								
								<?php if (strlen($post->post_title) > 70) {
								echo substr(the_title($before = '', $after = '', FALSE), 0, 70) . '...'; } else {
								the_title();
								} ?>
									<span class="serif"><p class="excerpt"><?php echo get_the_excerpt(); ?></p><p class="readmore">Read More...</p></span>
								</div>
							</a>
							<?php } ?>
							</footer> <!-- end article header -->
						
						</article> <!-- end article -->
						
						<?php endwhile; ?>	
						</div> <!-- end #main -->
						<?php if (MobileDTS::is('mobile') && !MobileDTS::is('ipad')){ ?>
						<?php } else { ?>
							<div id="sidebar1" class="sidebar fourcol" role="complementary">		
								<div class="inner-sidebar">
									<!--TWITTER STREAM -->
									<section class="tweets serif">	
										<?php twitterFeed($num*2); ?>
										</section>
								</div>
							</div>
						<?php } ?>
						</div> <!-- end #inner-content -->

						<?php //if (function_exists('page_navi')) { // if expirimental feature is active ?>
														
							
						<?php //} else { // if it is disabled, display regular wp prev & next links ?>
							<nav class="wp-prev-next">
								<ul class="clearfix">
								<?php $prev=get_previous_posts_link();
									  $next=get_next_posts_link(); ?>
									<li class="latest"><?php if($next){ next_posts_link('OLDER ENTRIES',0); } else { ?><span>OLDER ENTRIES</span><?php } ?><?php if($prev){ previous_posts_link('NEWER ENTRIES',0); } else { ?><span>NEWER ENTRIES</span><?php } ?></li>
								</ul>
							</nav>
						<?php //} ?>		
						<?php $wp_query = null; $wp_query = $temp;?>						
					
			</div> <!-- end #content -->
	</div> <!-- end #blog-container -->
						
<?php get_footer(); ?>