<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<h3>PLEASE CHOOSE YOUR SHIPPING COUNTRY</h3>

<?php woocommerce_shipping_calculator(); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post" class="cart">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

 <h3>SUMMARY</h3>

<table class="shop_table cart" cellspacing="20" width="100%">
	<thead>
		<tr>
			<th class="product-name"><?php _e('Product', 'woocommerce'); ?></th>
			<th class="product-price"><?php _e('Description', 'woocommerce'); ?></th>
			<th class="product-quantity"><?php _e('Quantity', 'woocommerce'); ?></th>
			<th class="product-subtotal"><?php _e('Price (inc. VAT)', 'woocommerce'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_table_item', $cart_item, $cart_item_key ) ); ?>">

						<!-- Product Name -->
						<td class="product-name">
							<?php
								if ( $_product->get_parent() )
									echo apply_filters( 'woocommerce_in_cart_product_title', get_the_title( $_product->get_parent() ) );
								else
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->post->post_title );																

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

               				// Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
               					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
							?>
						</td>

						<td class="product-variations">
							<?php 
							// Meta data
								if( $_product->get_parent() ){
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->post->post_title );	
								} else {
									echo $woocommerce->cart->get_item_data( $cart_item );
								}
							?>

						</td>

						<!-- Quantity inputs -->
						<td class="product-quantity">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = '1';
								} else {
									$data_min = apply_filters( 'woocommerce_cart_item_data_min', '', $_product );
									$data_max = ( $_product->backorders_allowed() ) ? '' : $_product->get_stock_quantity();
									$data_max = apply_filters( 'woocommerce_cart_item_data_max', $data_max, $_product );

									$product_quantity = sprintf( '<div class="quantity"><input name="cart[%s][qty]" data-min="%s" data-max="%s" value="%s" size="4" title="Qty" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $data_min, $data_max, esc_attr( $cart_item['quantity'] ) );
								}
								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
							<input type="submit" class="button" name="update_cart" value="<?php _e('Update', 'woocommerce'); ?>" /> 

						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
						</td>

						<!-- Remove from cart link -->
						<td class="product-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
							?>
						</td>
					</tr>
					<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr class="break"></tr>


					<tr class="col actions">

						<td class="coupon">

							<label for="coupon_code"><?php _e('Coupon', 'woocommerce'); ?>:</label> <input name="coupon_code" class="input-text" id="coupon_code" value="" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e('Apply', 'woocommerce'); ?>" />

							<?php do_action('woocommerce_cart_coupon'); ?>

						</td>
					</tr>


						<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
							<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
								<tr class="col tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
									<td><?php echo esc_html( $tax->label ); ?><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else : ?>
							<tr class="col tax-total">
								<td><?php echo esc_html( WC()->countries->tax_or_vat() ); ?><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
							</tr>
						<?php endif; ?>
					
						<?php if ( $woocommerce->cart->get_discounts_before_tax() ) {?>
						<tr class="col discount">
							<td class="discount">
								<?php _e( 'Discount', 'woocommerce' ); ?> 
								<a class="button" href="<?php echo add_query_arg( 'remove_discounts', '1', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( 'Remove', 'woocommerce' ); ?></a>
								<?php echo $woocommerce->cart->get_discounts_before_tax(); ?>
								
							</td>
						</tr>
					<?php } elseif ( $woocommerce->cart->get_discounts_after_tax() ) {  ?>
							<tr class="col discount">
								<td class="discount">
									<?php _e( 'Discount', 'woocommerce' ); ?> 
									<a class="button" href="<?php echo add_query_arg( 'remove_discounts', '2', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( 'Remove', 'woocommerce' ); ?></a>
									<?php echo $woocommerce->cart->get_discounts_after_tax(); ?>				
								</td>
							</tr>
					<?php } else { ?>
							<tr class="col discount">
								<td class="discount">
									<?php _e( 'Discount', 'woocommerce' ); ?> 
									<span class="amount">£0</span>
								</td>
							</tr>
					<?php } ?>

					<?php wp_nonce_field('woocommerce-cart') ?>


				<?php foreach ( $woocommerce->cart->get_fees() as $fee ) : ?>

					<tr class="fee fee-<?php echo $fee->id ?>">
						<td>
							<?php echo $fee->name ?>
							<?php
							if ( $woocommerce->cart->tax_display_cart == 'excl' )
								echo woocommerce_price( $fee->amount );
							else
								echo woocommerce_price( $fee->amount + $fee->tax );
						?>
						</td>
					</tr>

				<?php endforeach; ?>
				
				<!--<tr class="col disclaimer">
					<td>
						For buyers outside of the EU all VAT and taxes will be deducted at checkout. The total shown is an estimate.
					</td>
				</tr>-->


				<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

				<tr class="col totals">
					<td class="total">
						<?php _e( 'Total', 'woocommerce' ); ?>
					
						<?php echo $woocommerce->cart->get_total(); ?>
						<?php
							// If prices are tax inclusive, show taxes here
							if (  $woocommerce->cart->tax_display_cart == 'incl' ) {
								$tax_string_array = array();
								$taxes = $woocommerce->cart->get_taxes();

								if ( sizeof( $taxes ) > 0 )
									foreach ( $taxes as $key => $tax )
										$tax_string_array[] = sprintf( '%s %s', $tax, $woocommerce->cart->tax->get_rate_label( $key ) );
								elseif ( $woocommerce->cart->get_cart_tax() )
									$tax_string_array[] = sprintf( '%s tax', $tax );
							}
						?>
					</td>
					<td class="subtotal">
						<?php _e( 'Total Ex. Tax', 'woocommerce' ); ?>
						<?php echo $woocommerce->cart->get_total_ex_tax(); ?>
					</td>
				</tr>

				<tr class="disclaimer">
					<td>
						For buyers outside of the EU all VAT and taxes will be deducted at checkout. The total shown is an estimate.
					</td>
				</tr>

				<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</tbody>
</table>
		<input type="submit" class="checkout-button button alt" name="proceed" value="<?php _e('Proceed to Purchase', 'woocommerce'); ?>" />

		<?php do_action('woocommerce_proceed_to_checkout'); ?>
				<?php do_action( 'woocommerce_after_cart_contents' ); ?>

		<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_after_cart' ); ?>
