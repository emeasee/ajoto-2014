<?php
/*
Plugin Name: Paymill Gateway for WooCommerce
Plugin URI: http://primuxmedia.com
Description: Plugin which add the posibility to use Paymill for your WooCommerce setup
Version: 1.3.5
Author: Primux Media
Author URI: http://primuxmedia.com
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/
if(!defined('WC_PAYMILL_DIR')) {
	define('WC_PAYMILL_DIR', plugin_dir_path( __FILE__ ));
}
if(!defined('WC_PAYMILL_URL')) {
	define('WC_PAYMILL_URL', plugin_dir_url( __FILE__ ));
}
// Plugin Root File
if( !defined( 'WC_PAYMILL_PLUGIN_FILE' ) ) {
	define( 'WC_PAYMILL_PLUGIN_FILE', __FILE__ );
}

if( !defined( 'WC_PAYMILL_VERSION' ) ) {
	define('WC_PAYMILL_VERSION', '1.0');
}

/*
|--------------------------------------------------------------------------
| INTERNATIONALIZATION
|--------------------------------------------------------------------------
*/

function wc_paymill_textdomain() {
	// Set filter for plugin's languages directory
	$wc_paymill_lang_dir = dirname( plugin_basename( WC_PAYMILL_PLUGIN_FILE ) ) . '/languages/';
	$wc_paymill_lang_dir = apply_filters( 'wc_paymill_languages_directory', $wc_paymill_lang_dir );

	// Load the translations
	load_plugin_textdomain( 'wc_paymill', false, $wc_paymill_lang_dir );
}
add_action( 'init', 'wc_paymill_textdomain' );

/*
|--------------------------------------------------------------------------
| INCLUDES
|--------------------------------------------------------------------------
*/

function wc_paymill_setup() {
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
		return;
	}

	include_once( WC_PAYMILL_DIR . 'includes/class-paymill-gateway.php' );
	include_once( WC_PAYMILL_DIR . 'includes/class-paymill-gateway-subscription.php' );

	/**
	 * Add the Gateway to WooCommerce
	 * */
	function wc_paymill_add_gateway( $methods ) {

		if ( class_exists( 'WC_Subscriptions_Order' ) ) 
			$methods[] = 'WC_Paymill_Gateway_Subscription';
		else 
			$methods[] = 'WC_Paymill_Gateway';
		return $methods;
	}
	add_filter( 'woocommerce_payment_gateways', 'wc_paymill_add_gateway' );

}
add_action( 'plugins_loaded', 'wc_paymill_setup' );