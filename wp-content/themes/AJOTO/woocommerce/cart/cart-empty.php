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

	<?php echo get_new_royalslider(4);echo get_new_royalslider(5);echo get_new_royalslider(6); ?>

	<!--<p><a class="button" href="<?php echo get_permalink( get_page_by_title( 'Products' ) ); ?>"><?php _e('&larr; Return To Products', 'woocommerce') ?></a></p>-->
