<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in()  || ! $checkout->enable_signup ) return;

$info_message = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );
?>
<div>
	<div class="login">
<p class="woocommerce-info"><?php echo esc_html( $info_message ); ?> <a href="#" class="showlogin"><?php _e( 'Click here to login', 'woocommerce' ); ?></a></p>

<?php
	woocommerce_login_form(
		array(
			'message'  => __( 'Already registered? Login here', 'woocommerce' ),
			'redirect' => get_permalink( woocommerce_get_page_id( 'checkout') ),
			'hidden'   => true
		)
	);
?>
</div>

            <?php do_action( 'woocommerce_review_order_before_submit' ); ?>
