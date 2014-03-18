<?php get_header(); ?>
			<div id="content" class="page">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<section class="title">
							<p><?php the_title(); ?><span><?php echo get_post_meta($post->ID, 'sub', true); ?></span></p>
						</section>				
						<section class="post-content">
								<?php the_content(); ?>
						</section> <!-- end article section -->												
						<?php endwhile; ?>							
					<?php endif; ?>
    
			</div> <!-- end #content -->
<?php get_footer(); ?>