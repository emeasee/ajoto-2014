<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

	<div class="empty">
		<p><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></p>

		<?php do_action('woocommerce_cart_is_empty'); ?></p>
	</div>

	<p><a class="button" href="/shop">Return to the Shop</a></p>
