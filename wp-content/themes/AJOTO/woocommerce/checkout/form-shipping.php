<?php
/**
 * Checkout shipping information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="woocommerce-shipping-fields">
	<?php if ( WC()->cart->needs_shipping() && ! WC()->cart->ship_to_billing_address_only() ) : ?>

		<?php
			if ( empty( $_POST ) ) {

				$ship_to_different_address = get_option( 'woocommerce_ship_to_billing' ) == 'no' ? 1 : 0;
				$ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );

			} else {

				$ship_to_different_address = $checkout->get_value( 'ship_to_different_address' );

			}
		?>
		
		<h3>Shipping Details</h3>

		<p id="ship-to-different-address">
			<input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( $ship_to_different_address, 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
			<label for="ship-to-different-address-checkbox" class="checkbox"><?php _e( 'Ship to a different address?', 'woocommerce' ); ?></label>
		</p>

		<div class="shipping_address">
		<div class="left">
		<?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>
	<?php 
		$myshippingfields=array(
				"shipping_first_name",
				"shipping_last_name",
				"shipping_email",
				"shipping_phone"
				);

	foreach ($myshippingfields as $key) : ?>

		<?php woocommerce_form_field( $key, $checkout->checkout_fields['shipping'][$key], $checkout->get_value( $key ) ); ?>

	<?php endforeach; ?>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>
			<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

			<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>

				<?php if ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) : ?>

					<h3><?php _e( 'Additional Information', 'woocommerce' ); ?></h3>

				<?php endif; ?>

				<?php foreach ( $checkout->checkout_fields['order'] as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
	</div>
	<?php endif; ?>
	<div class="right">
		<?php 
			$myshippingfields=array(
					"shipping_company",
					"shipping_address_1",
					"shipping_address_2",
					"shipping_city",
					"shipping_state",
					"shipping_postcode",
					"shipping_country"
					);

		foreach ($myshippingfields as $key) : ?>

			<?php woocommerce_form_field( $key, $checkout->checkout_fields['shipping'][$key], $checkout->get_value( $key ) ); ?>

		<?php endforeach; ?>
	</div>
	</div>

</div>