<?php
/**
 * Grouped product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $product, $post;

// Put grouped products into an array
$grouped_products = array();
$quantites_required = false;

foreach ( $product->get_children() as $child_id ) {
	$child_product = $product->get_child( $child_id );

	if ( ! $child_product->is_sold_individually() && ! $child_product->is_type('external') )
		$quantites_required = true;

	$grouped_products[] = array(
		'product' => $child_product,
		'availability' => $child_product->get_availability()
	);
}
?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
			<?php foreach ( $grouped_products as $child_product ) : ?>
			<?php if ( get_post_meta( $child_product['product']->id, 'title', true) ) { ?>
				<div class="slideshow"><?php echo get_new_royalslider(get_post_meta( $child_product['product']->id, 'title', true)); ?></div>
			<?php } ?>
				<?php echo get_post_field('post_content', $child_product['product']->id);?>
				<div class="choice <?php echo $child_product['product']->get_sku(); ?>">
						<div class="container"><div class="add"></div><?php echo get_the_post_thumbnail( $child_product['product']->id, 'full', array('class' => 'byop option') ) ?></div>
						<span class="<?php echo $child_product['product']->get_sku(); ?>"><?php echo get_the_title( $child_product['product']->id ) ?><?php if ( get_post_meta( $child_product['product']->id, 'psubtitle', true) ) { echo '<br/>'.get_post_meta( $child_product['product']->id, 'psubtitle', true);} ?></span>
						<?php if ( $child_product['product']->is_type('external') ) :

							$product_url = get_post_meta( $child_product['product']->id, '_product_url', true );
							$button_text = get_post_meta( $child_product['product']->id, '_button_text', true );
							?>
							
							<a href="<?php echo $product_url; ?>" rel="nofollow" class="button alt"><?php echo apply_filters('single_add_to_cart_text', $button_text, 'external'); ?></a>

						<?php elseif ( ! $quantites_required ) : ?>

							<button type="submit" name="quantity[<?php echo $child_product['product']->id; ?>]" value="1" class="single_add_to_cart_button button alt"><?php _e('Add to cart', 'woocommerce'); ?></button>

						<?php else : ?>

							<?php woocommerce_quantity_input( array( 'input_name' => 'quantity['.$child_product['product']->id.']', 'input_value' => '0' ) ); ?>

						<?php endif; ?>
						<?php echo apply_filters( 'woocommerce_stock_html', '<small class="stock '.$child_product['availability']['class'].'">'.$child_product['availability']['availability'].'</small>', $child_product['availability']['availability'] ); ?>

						<?php echo apply_filters( 'woocommerce_short_description', $child_product['product']->post->post_excerpt ) ?>

						<strong id="<?php echo $child_product['product']->get_price(); ?>"><?php echo $child_product['product']->get_price_html(); ?></strong>
						<small id="<?php echo $child_product['product']->get_price_excluding_tax(); ?>"><span class="amount">£<?php echo $child_product['product']->get_price_excluding_tax(); ?></span> EXCLUDING VAT<br/>(Price for non-EU customers)</small>
						<button type="submit" class="single_add_to_cart_button button alt" style="width: 100%;margin-top: 30px!important;"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button>
				</div>
			<?php endforeach; ?>


	<?php if ( $quantites_required ) : ?>

		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button>
		<!--<div class="clear"/>
		<input style="margin-top:10px;" type="reset" class="button" value="CLEAR" />
		-->
		<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	<?php endif; ?>

</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>