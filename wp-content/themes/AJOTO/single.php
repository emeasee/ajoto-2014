<?php get_header(); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="content" class="single" itemprop="articleBody">	
				<section class="title small">
					<p><?php $category = get_the_category(); echo $category[0]->cat_name; ?></p>
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
							if(in_category( $category->term_id )){ $current = 'current';} else {$current = $category->slug;};
							echo '<a class="'.$current.'" href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><div></div>';
						}?>
					</div>
				</section>

					<section class="title subhead">
						<p><?php the_title(); ?></br>
						<span class="sans-serif"><?php echo get_the_excerpt();?></span></p>
						<a href="<?php echo get_permalink(get_adjacent_post(true,'',true)); ?>" class="arrow left"></a>
						<a href="<?php echo get_permalink(get_adjacent_post(true,'',false)); ?>" class="arrow right"></a>
					</section>
				</section>
				<section class="gallery rsDefaultBlack">
					<?php 
							$attachments = wpba_get_attachments(array(
								'post_id' => $post->ID,
								'show_post_thumbnail'  => false
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
					<p class="by">Posted by <?php echo the_author_meta("nickname"); ?></p>
					<p style="font-size: 0.9em;margin-top:0;margin-bottom:0;"><?php the_date('jS F Y'); ?></p>
				</section>				
				
					<nav class="wp-prev-next">				
						<ul class="clearfix">
							<li class="latest single">
								<?php if(get_adjacent_post(true, '', true)){ ?>
									<span class="old link"><i class="icon-arrow_left"></i><?php previous_post_link('%link','PREVIOUS', 'TRUE'); 
								} else { ?>
									<span class="old empty"><i class="icon-arrow_left"></i><p>PREVIOUS</p></span> 
								<?php } ?></span>
								<span class="back">
									<a href="../journey" onclick="goBack(event)">BACK</a>
								</span>
								<?php if(get_adjacent_post(true, '', false)){ ?>
									<span class="new link"><i class="icon-arrow_right"></i><?php next_post_link('%link','NEXT', 'TRUE'); 
								} else { ?>
									<span class="new empty"><i class="icon-arrow_right"></i><p>NEXT</p></span>
								<?php } ?></span>
							</li>
						</ul>
					</nav>
			</div> <!-- end #content -->
	<?php endwhile; ?>			
	<?php endif; ?>
<?php get_footer(); ?>
