<?php
	/*
	Template Name: New Blog (WIP)
	*/
	?>
<?php get_header(); ?>
		<div id="content" class="blog">
		<section class="title small">
			<p>JOURNEY<span>SHARING THE PEOPLE, PLACES AND PROCESS INVOLVED IN EVERYTHING WE DO</span></p>
		</section>
		<section class="filter">
			<div class="links">
			<a class="current" href="../../journey">ALL</a>
				<?php
					$args = array(
				  		'orderby' => 'name',
				  		'parent' => 0
				  	);
					$categories = get_categories( $args );
					foreach ( $categories as $category ) {
						echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a>';
				}?>
			</div>
		</section>
			<div id="inner-content" class="wrap clearfix">
				<div id="main" role="main">
					<?php
						 $temp = $wp_query;
						 $wp_query= null;
						 $wp_query = new WP_Query();
						 $social = 'social';$exclude = get_category_by_slug($social);$ex_id = $exclude->cat_ID;
						 $wp_query->query('posts_per_page=51&cat=-'.$ex_id.'&author=-1&paged='.$paged);
						 while( $wp_query->have_posts() ) : $wp_query->the_post();
						 $category = get_the_category();
					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix transition'); ?> role="article">
							<?php if (in_category(array('news','stories','events'))){?>
								<section class="clearfix cover" rel="<?php the_permalink() ?>">
									<a href="<?php the_permalink() ?>"><?php echo the_post_thumbnail('medium'); ?></a>
								</section>
								<footer class="post-title">
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
							<?php } else { ?>
								<section class="clearfix cover" rel="<?php the_permalink() ?>">
									<a href="<?php the_permalink() ?>"><?php echo the_post_thumbnail('medium'); ?></a>
								</section> <!-- end article section -->

								<footer class="post-title">

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
						<?php } ?>
						</article> <!-- end article -->

						<?php endwhile; ?>
						</div> <!-- end #main -->
						</div> <!-- end #inner-content -->

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
						<?php $wp_query = null; $wp_query = $temp;?>

			</div> <!-- end #content -->
<?php get_footer(); ?>
