<?php
	/*
	Template Name: Blog
	*/
	?>
<?php get_header(); ?>
		<div id="content" class="blog">
		<section class="title small">
			<p><?php single_cat_title(); ?></p>
		</section>
		<section class="filter">
			<div class="links">
			<a href="../../journey">ALL</a>
				<?php
					$args = array(
				  		'orderby' => 'name',
				  		'parent' => 0
				  	);
					$categories = get_categories( $args );
					foreach ( $categories as $category ) {
						if(is_category( $category->term_id )){ $current = 'current';} else {$current = $category->slug;};
						echo '<a class="'.$current.'" href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><div></div>';
				}?>
			</div>
		</section>
			<div id="inner-content" class="wrap clearfix">
				<div id="main" role="main">
					<?php 
						 $temp = $wp_query;
						 $wp_query= null;
						 $wp_query = new WP_Query(); 
						 $wp_query->query('posts_per_page=51&cat='.$cat.'&author=-1&paged='.$paged); 
						 while( $wp_query->have_posts() ) : $wp_query->the_post();
						 $category = get_the_category();
					?>
							<?php if (in_category(array("news","stories","news","events"))){?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix, transition'); ?> role="article">
								<section class="clearfix cover" rel="<?php the_permalink() ?>">
									<a href="<?php the_permalink() ?>"><?php echo the_post_thumbnail('medium'); ?></a>	
								</section>	
								<footer class="post-title" style="cursor:pointer;">
									<div class="cell" href="<?php the_permalink() ?>">
										<div class="h2">
											<p class="title"><?php if (strlen($post->post_title) > 70) {
											echo substr(the_title($before = '', $after = '', FALSE), 0, 70) . '...'; } else {
											the_title();
											} ?></p>
											<span class="category"><?php echo $category[0]->cat_name; ?></span>
											<span class="date"><?php echo get_the_date(); ?></span>
										</div>
									</div>
								</footer>
							</article>
							<?php } elseif (in_category("social")) { 
								if(has_tag('twitter')){?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix transition'); ?> role="article">
									<section class="clearfix cover tweet" data-chrome="transparent" rel="<//?php the_permalink() ?>">
										<div class="table icon-bird"><p><?php echo get_the_content(); ?></p></div>
										<a href="http://twitter.com/ajoto" class="twitterdatelink">@AJOTO</a>
									</section>
								</article>
								<?php } elseif(has_tag('instagram')){?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix transition'); ?> role="article">
									<section class="clearfix cover ig" rel="<//?php the_permalink() ?>">
										<a href="<?php echo get_the_content(); ?>"><?php echo the_post_thumbnail('medium'); ?></a>
									</section>
								</article>
							<?php } } else { ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix, transition'); ?> role="article">
								<section class="clearfix cover" rel="<?php the_permalink() ?>">
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'medium' ); ?></a>						
								</section> <!-- end article section -->
								
								<footer class="post-title" style="cursor:pointer;">

								<div class="cell" href="<?php the_permalink() ?>">
									<div class="h2">
									
									<p class="title"><?php if (strlen($post->post_title) > 70) {
									echo substr(the_title($before = '', $after = '', FALSE), 0, 70) . '...'; } else {
									the_title();
									} ?></p>
										<span class="category"><?php echo $category[0]->cat_name; ?></span>
										<span class="date"><?php echo get_the_date(); ?></span>
									</div>
								</div>
								</footer> <!-- end article header -->
							</article> <!-- end article -->
						<?php } ?>
						
						<?php endwhile; ?>	
						</div> <!-- end #main -->
						</div> <!-- end #inner-content -->														
							
						<?php //} else { // if it is disabled, display regular wp prev & next links ?>
							<nav class="wp-prev-next">
								<ul class="clearfix">
								<?php $prev=get_previous_posts_link();
									  $next=get_next_posts_link(); ?>
									<li class="latest">
										<?php if($next){ ?> 
											<span class="old link"><i class="icon-arrow_left"></i><?php next_posts_link('OLDER ENTRIES',0); ?></span> 
										<?php } else { ?>
											<span class="old empty"><i class="icon-arrow_left"></i> <p>OLDER ENTRIES</p></span>
										<?php } ?>

										<?php if($prev){ ?>
											<span class="new link"><i class="icon-arrow_right"></i><?php previous_posts_link('NEWER ENTRIES',0); ?></span> 
										<?php } else { ?>
											<span class="new empty"><i class="icon-arrow_right"></i><p>NEWER ENTRIES</p></span>
										<?php } ?>
									</li>
								</ul>
							</nav>
						<?php //} ?>		
						<?php $wp_query = null; $wp_query = $temp;?>						
					
			</div> <!-- end #content -->						
<?php get_footer(); ?>