<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<div class="price">
        <strong><?php echo $price_html; ?></strong>
        <small><span class="amount">£<?php echo $product->get_price_excluding_tax(); ?></span><br/> EXCLUDING VAT<br/>(Price for non-EU customers)</small>
    </div>
<?php endif; ?>