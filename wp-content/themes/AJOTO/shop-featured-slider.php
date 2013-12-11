	<?php
		$args = array(
			'post_type' => 'product',
			'meta_key' => '_featured',
			'meta_value' => 'yes',
			'posts_per_page' => 12
			);
		$index = 0;
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?php //if (in_array($index, range(0,12,3))){ ?><div class="rsContent"><ul class="products slide"> <?php //} ?>
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
				<?php //if (in_array($index, range(2,14,3))){ ?></ul></div> <?php //} ?>
				<?php $index++;
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
