<?php
	/*
	Template Name: Parent Page
	*/
 ?>
<?php get_header(); ?>
<div id="container">

<div id="content" class="parent">
		<!--<header>
			<?php echo get_new_royalslider(get_post_meta($post->ID, 'first', true)); ?>
		</header>

        <section class="title">
            <p class="serif"><?php the_title(); ?></br>
            <span class="sans-serif"><?php echo get_post_meta($post->ID, 'sub', true); ?></span></p>
        </section>  -->
	
        <div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'first', true)); ?></div>

		<div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'second', true)); ?></div>

        <div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'third', true)); ?></div>

	</div>
</div>
<?php get_footer(); ?>
