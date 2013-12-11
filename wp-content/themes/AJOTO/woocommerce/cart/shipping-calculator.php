<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( get_option('woocommerce_enable_shipping_calc')=='no' || ! $woocommerce->cart->needs_shipping() ) return;
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="shipping_calculator" action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
	<tr class="shipping">
		<td class="form-row form-row-wide">
			<label for="calc_shipping_country"><?php _e('Country', 'woocommerce'); ?>:</label>
			<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
				<option value=""><?php _e( 'Select a country&hellip;', 'woocommerce' ); ?></option>
				<?php
					foreach( $woocommerce->countries->get_allowed_countries() as $key => $value )
						echo '<option value="' . $key . '"' . selected( $woocommerce->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				?>
			</select>
		</td>
		<tr class="clear"></tr>
		<td>
			<button type="submit" name="calc_shipping" value="1" class="button"><?php _e( 'Update', 'woocommerce' ); ?></button>
		</td>
		<?php $woocommerce->nonce_field('cart') ?>
	</tr>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
