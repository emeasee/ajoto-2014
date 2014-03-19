<?php get_header(); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="content" class="single" itemprop="articleBody">	
				<section class="title small">
					<p><?php $category = get_the_category(); echo $category[0]->cat_name; ?><span>A SHORT 140 CHARACTER BLURB TO INTRODUCE THE PAGE BEING VIEWED</span></p>
				</section>
				<section class="filter">
					<div class="links">
					<a href="../../journal">ALL</a>
						<?php
							$args = array(
					  		'orderby' => 'name',
					  		'parent' => 0
					  	);
						$categories = get_categories( $args );
						foreach ( $categories as $category ) {
							if(in_category( $category->term_id )){ $current = 'current';} else {$current = $category->slug;};
							echo '<a class="'.$current.'" href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><div></div>';
						}?>
					</div>
				</section>

					<section class="title">
						<p><?php the_title(); ?></br>
						<span class="sans-serif">THIS IS WHERE THE 140 CHARACTER EXCERPT FROM THE POST APPEARS.</span></p>
						<a href="<?php echo get_permalink(get_adjacent_post(true,'',true)); ?>" class="arrow left"></a>
						<a href="<?php echo get_permalink(get_adjacent_post(true,'',false)); ?>" class="arrow right"></a>
					</section>
				</section>
				<section class="gallery rsDefaultBlack">
					<?php 
							$attachments = get_posts( array(
								'post_type' => 'attachment',
								'posts_per_page' => -1,
								'post_parent' => $post->ID,
								'exclude'     => get_post_thumbnail_id()
							) );

							if ( $attachments ) {
								foreach ( $attachments as $attachment ) {
									$thumbimg = wp_get_attachment_image( $attachment->ID, 'full', false );
									echo '<span class="img">' . $thumbimg . '</span>';
								}
								
							}
					?>				
				</section> <!-- end article section -->
				<section class="screen">
						<div class="more-less">
							<div class="more-block">
								<p><?php echo get_the_content(); ?>	</p>
							</div>
						</div>				
					<div id="break"></div>
					<p class="by">Posted by <?php echo the_author_meta("nickname"); ?></p>
					<p style="font-size: 0.9em;"><?php the_date('jS F Y'); ?></p>
				</section>				
				
					<nav class="wp-prev-next">				
						<p>
							<?php if(get_adjacent_post(true, '', true)){ ?>
								<span class="next-link"><?php previous_post_link('%link','PREVIOUS', 'TRUE'); 
							} else { ?>
								<span class="next-link light">PREVIOUS</span> 
							<?php } ?></span>
							<span class="back">
								<a href="../journeys" onclick="goBack(event)">BACK</a>
							</span>
							<?php if(get_adjacent_post(true, '', false)){ ?>
								<span class="prev-link"><?php next_post_link('%link','NEXT', 'TRUE'); 
							} else { ?>
								<span class="prev-link light">NEXT</span>
							<?php } ?></span>
						</p>
					</nav>
			</div> <!-- end #content -->
	<?php endwhile; ?>			
	<?php endif; ?>
<?php get_footer(); ?>
