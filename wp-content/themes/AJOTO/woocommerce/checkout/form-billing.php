<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>
	<div class="create-account">
		<p><?php _e( "Don't have an account yet? You can register below", 'woocommerce' ); ?></p>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>


		<?php foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>

			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

		<?php endforeach; ?>

		<div class="clear"></div>
			<?php if ( $checkout->enable_guest_checkout ) : ?>

		<p class="form-row">
			<input class="input-checkbox" id="createaccount" <?php checked($checkout->get_value('createaccount'), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'CREATE AN ACCOUNT?', 'woocommerce' ); ?></label>
		</p>

	<?php endif; ?>

	</div>

	<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

<?php endif; ?>

<?php if ( $woocommerce->cart->ship_to_billing_address_only() && $woocommerce->cart->needs_shipping() ) : ?>

	<h3><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

<?php else : ?>

	<h3><?php _e( 'Billing Details', 'woocommerce' ); ?></h3>

<?php endif; ?>

<?php do_action('woocommerce_before_checkout_billing_form', $checkout ); ?>

<div class="left">

<?php 
	$mybillingfields=array(
			"billing_first_name",
			"billing_last_name",
			"billing_email",
			"billing_phone"
			);

foreach ($mybillingfields as $key) : ?>

	<?php woocommerce_form_field( $key, $checkout->checkout_fields['billing'][$key], $checkout->get_value( $key ) ); ?>

<?php endforeach; ?>

<p class="form-row disclaimer">DISCLAIMER<br/><br/>Your information is used for the purpose of completing your order only and will not be shared with any third party.</p>
</div>

<div class="right">
<?php 
	$mybillingfields=array(
			"billing_company",
			"billing_address_1",
			"billing_address_2",
			"billing_city",
			"billing_state",
			"billing_postcode",
			"billing_country"
			);

foreach ($mybillingfields as $key) : ?>

	<?php woocommerce_form_field( $key, $checkout->checkout_fields['billing'][$key], $checkout->get_value( $key ) ); ?>

<?php endforeach; ?>
</div>

<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>



