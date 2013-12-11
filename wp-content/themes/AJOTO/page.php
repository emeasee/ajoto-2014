<?php get_header(); ?>
			
		<div id="container">
			<div id="content" class="page">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<section class="title">
							<p class="serif"><?php the_title(); ?></br>
							<span class="sans-serif"><?php echo get_post_meta($post->ID, 'sub', true); ?></span></p>
						</section>					
						<section class="post-content">
								<?php the_content(); ?>
						</section> <!-- end article section -->												
						<?php endwhile; ?>							
					<?php endif; ?>
    
			</div> <!-- end #content -->
		</div>

<?php get_footer(); ?>