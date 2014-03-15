<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $current_user;
?>          
<div id="quick-convert">
        <p class="sans-serif">CURRENCY: </p>

            <select name="currselect" id="currselect">
                <option value="GBP">British Pound</option>
                <option value="EUR">Euro</option>
                <option value="USD">US Dollar</option>
                <option value="JPY">Japanese Yen</option>
            </select>

        <p class="c-info"></p>
        <div id="cdis">
            <h4>NOTICE</h4>
            <p>Please be aware that our this conversion is based on up to date rates but should still be considered approximate.<?php createdTime(); ?></p>
        </div>
</div>
<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

    <p class="total"><span style="float:left;"><?php _e('CURRENT TOTAL', 'woocommerce'); ?>:</span><strong id="<?php echo $woocommerce->cart->subtotal; ?>"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></strong><span style="float:right;">INCLUDING VAT</span></p>
    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
<p class="buttons">

        <a class="cart-contents sans-serif" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart"><?php _e('BASKET', 'woocommerce'); ?><?php echo sprintf(_n(' (%d)', ' (%d)', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?><strong class="am" id="<?php echo $woocommerce->cart->subtotal; ?>"> - <?php echo $woocommerce->cart->get_cart_total(); ?></strong></a>
    
    <?php else : ?>
<p class="buttons">
<?php endif; ?>
<?php if ( is_user_logged_in() ) { ?>
    <a class="sans-serif" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>">Account</a>
    <a class="sans-serif" href="<?php echo wp_logout_url( home_url() ) ?>">Log Out</a>
 <?php } 
 else { ?>
    <a class="sans-serif" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>" class="login"><?php _e('LOGIN','woothemes'); ?></a>
 <?php } ?>
</p>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
