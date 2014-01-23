<?php
	/*
	Template Name: New Blog (WIP)
	*/
	?>
<?php get_header(); ?>
	<div id="container">
		<div id="content" class="blog">
		<section class="filter">
			<div class="links">
				<?php
					$args = array(
				  		'orderby' => 'name',
				  		'parent' => 0
				  	);
					$categories = get_categories( $args );
					foreach ( $categories as $category ) {
						echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><div></div>';
				}?>
			</div>
		</section>
			<div id="inner-content" class="wrap clearfix">
				<div id="main" role="main">
					<?php 
						 $temp = $wp_query;
						 $wp_query= null;
						 $wp_query = new WP_Query(); 
						 $wp_query->query('posts_per_page=10&author=-1&paged='.$paged); 
						 while( $wp_query->have_posts() ) : $wp_query->the_post();
					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix, threecol, transition'); ?> role="article">
							<?php if (in_category("tumblr")){?>
								<section class="clearfix cover" rel="<?php the_permalink() ?>">
									<?php echo get_the_content(); ?>		
								</section>	
								<footer class="post-title" style="cursor:pointer;">
									<a href="<?php the_permalink() ?>">
										<div class="h2">
											<?php the_title(); ?>
											<span class="serif"><p><?php echo get_the_date(); ?></p></span>
										</div>
									</a>
								</footer>
							<?php } elseif (in_category("twitter")) { ?>
								<section class="clearfix cover tweet" data-chrome="transparent" rel="<?php the_permalink() ?>">
									<?php echo get_the_content(); ?>
									<a href="http://twitter.com/ajoto" class="twitterdatelink">@AJOTO</a>
								</section>
							<?php } elseif (in_category("instagram")) { ?>
								<section class="clearfix cover ig" rel="<?php the_permalink() ?>">
									<?php echo get_the_content(); ?>		
								</section>	
							<?php } else { ?>
								<section class="clearfix cover" rel="<?php the_permalink() ?>">
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'article' ); ?></a>						
								</section> <!-- end article section -->
								
								<footer class="post-title" style="cursor:pointer;">

								<a href="<?php the_permalink() ?>">
									<div class="h2">
									
									<?php if (strlen($post->post_title) > 70) {
									echo substr(the_title($before = '', $after = '', FALSE), 0, 70) . '...'; } else {
									the_title();
									} ?>
										<span class="serif"><p class="excerpt"><?php echo get_the_excerpt(); ?></p><p class="readmore">Click to read the full journey...</p></span>
									</div>
								</a>
								</footer> <!-- end article header -->
						<?php } ?>
						</article> <!-- end article -->
						
						<?php endwhile; ?>	
						</div> <!-- end #main -->
						</div> <!-- end #inner-content -->														
							
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