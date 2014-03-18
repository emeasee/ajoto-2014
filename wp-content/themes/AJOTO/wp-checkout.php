<?php
	/*
	Template Name: Wordpress Checkout pages template
	*/
 ?>

<?php get_header(); ?>
			<div id="content" class="page">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<section class="title">
							<p class="serif"><?php the_title(); ?></br>
							<span class="sans-serif"><?php echo get_post_meta($post->ID, 'sub', true); ?></span></p>
						</section>					
						<section class="items" style="min-height:100%;">
								<?php the_content(); ?>
						</section> <!-- end article section -->												
						<?php endwhile; ?>							
					<?php endif; ?>
    
			</div> <!-- end #content -->
<?php get_footer(); ?>