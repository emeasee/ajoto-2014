<?php
/**
 * WC_Paymill_Gateway class.
 */
class WC_Paymill_Gateway extends WC_Payment_Gateway {

	function __construct() {
		$this->id          		= 'paymill';
		$this->method_title    	= __( 'Paymill', 'wc_paymill' );
		$this->icon         	= WC_PAYMILL_URL .'img/cards.png';
		$this->has_fields      	= true;
		$this->api_endpoint     = 'https://api.paymill.de/v2/';
		$this->supports     	= array( 'subscriptions', 'products', 'subscription_cancellation', 'subscription_reactivation', 'subscription_suspension', 'subscription_date_changes' );

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Get setting values
		$this->title     	= $this->get_option( 'title' );
		$this->description  = $this->get_option( 'description' );
		$this->enabled      = $this->get_option( 'enabled' );
		$this->testmode     = $this->get_option( 'testmode' );
		$this->cc_name      = $this->get_option( 'cc_name' );

		$this->private_key  = $this->testmode == 'no' ? $this->get_option( 'private_key' ) : $this->get_option( 'test_private_key' );
		$this->public_key   = $this->testmode == 'no' ? $this->get_option( 'public_key' ) : $this->get_option( 'test_public_key' );

		// Actions
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'scripts' ) );
		add_action( 'wp_head', array( &$this, 'public_key' ) );
		add_action( 'admin_notices', array( &$this, 'checks' ) );
	}

	/**
	 * Setup all the fields needed in the administation
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title' => __( 'Enable/Disable', 'wc_paymill' ),
				'label' => __( 'Enable Paymill', 'wc_paymill' ),
				'type' => 'checkbox',
				'description' => '',
				'default' => 'yes'
			),
			'debit' => array(
				'title' => __( 'Use Paymill Debit', 'wc_paymill' ),
				'type' => 'checkbox',
				'default' => ''
			),
			'title' => array(
				'title' => __( 'Title', 'wc_paymill' ),
				'type' => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.', 'wc_paymill' ),
				'default' => __( 'Credit card (Paymill)', 'wc_paymill' )
			),
			'description' => array(
				'title' => __( 'Description', 'wc_paymill' ),
				'type' => 'textarea',
				'description' => __( 'This controls the description which the user sees during checkout.', 'wc_paymill' ),
				'default' => 'Pay with your credit card via Paymill.'
			),
			'testmode' => array(
				'title' => __( 'Test mode', 'wc_paymill' ),
				'label' => __( 'Enable Test Mode', 'wc_paymill' ),
				'type' => 'checkbox',
				'description' => __( 'Place the payment gateway in test mode using test API keys.', 'wc_paymill' ),
				'default' => 'yes'
			),
			'private_key' => array(
				'title' => __( 'Private Key', 'wc_paymill' ),
				'type' => 'text',
				'description' => __( 'Get your API keys from your Paymill My Account -> Settings page.', 'wc_paymill' ),
				'default' => ''
			),
			'public_key' => array(
				'title' => __( 'Public Key', 'wc_paymill' ),
				'type' => 'text',
				'default' => ''
			),
			'test_private_key' => array(
				'title' => __( 'Private test key', 'wc_paymill' ),
				'type' => 'text',
				'default' => ''
			),
			'test_public_key' => array(
				'title' => __( 'Public test key', 'wc_paymill' ),
				'type' => 'text',
				'default' => ''
			),
			'cc_name' => array(
				'title' => __( 'Use Credit Card Name', 'wc_paymill' ),
				'type' => 'checkbox',
				'default' => ''
			)
		);
	}

	public function checks() {

	}

	/**
	 * Check if we can us the plugin
	 */
	public function is_available() {
		global $woocommerce;

		if ( $this->enabled == "yes" ) {

			// Required fields
			if ( !$this->private_key ||  !$this->public_key ) {
				return false;
			}

			return true;
		}

		return false;
	}

	/**
	 * Output the Credit Card Fields
	 */
	public function payment_fields() {
		global $woocommerce;
		ob_start(); ?>

		<fieldset>
			<?php if ( $this->testmode == 'yes' ) : ?>
				<?php _e( '<p>TEST MODE ENABLED. In test mode, you can use the card number 4111111111111111 for Visa and 5500000000000004 for Mastercard or 4012888888881881 to test 3-D Secure.  You can use any CVC and a valid expiration date.</p>', 'wc_paymill' ); ?>
				<?php if ( $this->get_option( 'debit' ) == 'yes' ): ?>
				<?php _e( '<p>For debit, you can use account number: 1234567890 and Bank Code: 40050150</p>', 'wc_paymill' ); ?>
				<?php endif ?>
			<?php endif; ?>

			<?php if ( $this->description ) : ?>
				<p><?php echo $this->description; ?></p>
			<?php endif; ?>

			<div class="paymill_new_card">

				<?php if ( $this->get_option( 'debit' ) == 'yes' ):  ?>
				<p class="form-row form-row-wide">
				<a class="button alt payment-type" data-type="creditcard" href="#"><?php _e( 'Credit Card', 'wp_paymill' ) ?></a>
						<a class="button payment-type" data-type='debit' href="#"><?php _e( 'Debit Account', 'wp_paymill' ) ?></a>
					</p>
				<?php endif ?>

				<?php echo $this->creditcard_form(); ?>

				<?php if ( $this->get_option( 'debit' ) == 'yes' ):  ?>
				<?php echo $this->debit_form(); ?>
				<?php endif ?>
				<div class="clear"></div>
			</div>
			<input type="hidden" name="pm_amount" class="pm_amount" value="<?php echo $woocommerce->cart->total * 100; ?>">
			<input type="hidden" name="pm_currency" class="pm_currency" value="<?php echo get_woocommerce_currency(); ?>">

		</fieldset>
		<?php
		echo apply_filters( 'wc_paymill_payment_fields', ob_get_clean( ) );
	}

	public function debit_form() {
		ob_start(); ?>
		<div id="debit" style="display:none;">
			<p class="form-row form-row-wide">
				<label for="paymill_cart_number"><?php _e( "Account holder", 'wc_paymill' ) ?> <span class="required">*</span></label>
				<input type="text" name="account-holder" autocomplete="off" class="input-text account-holder" />
			</p>
			<p class="form-row form-row-wide">
				<label for="paymill_cart_number"><?php _e( "Account number", 'wc_paymill' ) ?> <span class="required">*</span></label>
				<input type="text" autocomplete="off" class="input-text account-number" />
			</p>
			<p class="form-row form-row-wide">
				<label for="paymill_cart_number"><?php _e( "Bank code", 'wc_paymill' ) ?> <span class="required">*</span></label>
				<input type="text" autocomplete="off" class="input-text bank-code" />
			</p>
		</div>
		<?php
		return ob_get_clean();
	}

	public function creditcard_form() {
		global $woocommerce;
		ob_start(); ?>
		<div id="creditcard">
			<?php if ( $this->cc_name == 'yes' ): ?>
				<p class="form-row form-row-wide">
					<label for="cc_name"><?php _e( "Credit Cardholder's Name", 'wc_paymill' ) ?> <span class="required">*</span></label>
					<input type="text" name="account-holder" autocomplete="off" class="cc_name" id="cc_name" />
				</p>
			<?php endif ?>
			<p class="form-row form-row-wide">
				<label for="paymill_cart_number"><?php _e( "Credit Card number", 'wc_paymill' ) ?> <span class="required">*</span></label>
				<input type="text" autocomplete="off" class="input-text card-number" />
			</p>
			<div class="clear"></div>
			<p class="form-row form-row-first">
				<label for="cc-expire-month"><?php _e( "Expiration date", 'wc_paymill' ) ?> <span class="required">*</span></label>
				<select id="cc-expire-month" class="woocommerce-select woocommerce-cc-month card-expiry-month">
					<option value=""><?php _e( 'Month', 'wc_paymill' ) ?></option>
					<?php $months = array();
		for ( $i = 1; $i <= 12; $i++ ) :
			$timestamp = mktime( 0, 0, 0, $i, 1 );
		$months[date( 'm', $timestamp )] = date( 'F', $timestamp );
		endfor;
		foreach ( $months as $num => $name ) printf( '<option value="%s">%s</option>', $num, $name ); ?>
				</select>
				<select id="cc-expire-year" class="woocommerce-select woocommerce-cc-year card-expiry-year">
					<option value=""><?php _e( 'Year', 'wc_paymill' ) ?></option>
					<?php for ( $i = date( 'y' ); $i <= date( 'y' ) + 15; $i++ ) printf( '<option value="20%u">20%u</option>', $i, $i ); ?>
				</select>
			</p>
			<p class="form-row form-row-last">
				<label for="paymill_card_csc"><?php _e( "Card security code", 'wc_paymill' ) ?> <span class="required">*</span></label>
				<input type="text" id="paymill_card_csc" maxlength="4" style="width:4em;" autocomplete="off" class="input-text card-cvc" />
				<span class="help paymill_card_csc_description"></span>
			</p>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Add the settings to the Admin Options page
	 */
	public function admin_options() {
?>
    	<h3><?php _e( 'Paymill', 'wc_paymill' ); ?></h3>
    		<table class="form-table">
	    		<?php $this->generate_settings_html(); ?>
			</table><!--/.form-table-->
    		<?php
	}

	/**
	 * Loads the scripts needed for the Gateway, but only on checkout page.
	 */
	public function scripts() {
		global $woocommerce;

		if ( ! is_checkout() )
			return;

		wp_enqueue_script( 'paymill-js', 'https://bridge.paymill.com', array( 'jquery' ) );

		wp_enqueue_script( 'wc-paymill-js', WC_PAYMILL_URL . '/js/wc-paymill.js', array( 'jquery', 'paymill-js' ), WC_PAYMILL_VERSION );
		$translation = array(
				'internal_server_error' => __('Communication with PSP failed', 'wc_paymill'),
				'invalid_public_key' => __('Invalid Public Key', 'wc_paymill'),
				'unknown_error' => __('Unknown Error', 'wc_paymill'),
				'3ds_cancelled' => __('Password Entry of 3-D Secure password was cancelled by the user', 'wc_paymill'),
				'field_invalid_card_number' => __('Missing or invalid creditcard number', 'wc_paymill'),
				'field_invalid_card_exp_year' => __('Missing or invalid expiry year', 'wc_paymill'),
				'field_invalid_card_exp_month' => __('Missing or invalid expiry month', 'wc_paymill'),
				'field_invalid_card_exp' => __('Card is no longer valid or has expired', 'wc_paymill'),
				'field_invalid_card_cvc' => __('Invalid checking number', 'wc_paymill'),
				'field_invalid_card_holder' => __('Invalid cardholder', 'wc_paymill'),
				'field_invalid_amount_int' => __('Invalid or missing amount for 3-D Secure', 'wc_paymill'),
				'field_invalid_currency' => __('Invalid or missing currency code for 3-D Secure', 'wc_paymill'),
				'field_invalid_account_number' => __('Missing or invalid bank account number', 'wc_paymill'),
				'field_invalid_account_holder' => __('Missing or invalid bank account holder', 'wc_paymill'),
				'field_invalid_bank_code' => __('Missing or invalid bank code', 'wc_paymill')
			);

		wp_localize_script( 'wc-paymill-js', 'wcPaymill', $translation );
	}

	public function public_key() {
		if ( ! is_checkout() )
			return;

		echo '<script>var PAYMILL_PUBLIC_KEY = "' . $this->public_key . '";</script>';
	}

	/**
	 * Process the payment
	 */
	function process_payment( $order_id ) {
		global $woocommerce;

		$order = new WC_Order( $order_id );

		$paymill_token = isset( $_POST['paymill_token'] ) ? woocommerce_clean( $_POST['paymill_token'] ) : '';

		// Try to use the Paymill API for paymnet
		try {

			// Check token
			if ( empty( $paymill_token ) )
				throw new Exception( __( 'Please make sure your card details have been entered correctly and that your browser supports JavaScript.', 'wc_paymill' ) );

			// Check amount
			if ( $order->order_total * 100 < 50 )
				throw new Exception( __( 'Minimum order total is 0.50', 'wc_paymill' ) );

			// Contact the API
			require_once WC_PAYMILL_DIR . 'includes/Paymill/Transactions.php';

			$params = array(
				'amount'   => $order->order_total * 100, // amount in cents
				'currency'   => strtoupper( get_woocommerce_currency() ),
				'token'   => $paymill_token,
				'description'  => sprintf( __( '%s - Order %s', 'wc_paymill' ), esc_html( get_bloginfo( 'name' ) ), $order->get_order_number() )
			);

			$transactionsObject = new Services_Paymill_Transactions( $this->private_key, $this->api_endpoint );
			$transaction = $transactionsObject->create( $params );

			if ( $transaction['response_code'] != 20000  ) {
				$error = $this->getErrorMessage( $transaction['response_code'] );
				throw new Exception( $error );
			} else {

				// Do action after completion
				do_action( 'wc_paymill_transaction_completed', $transaction );

				// Add order note
				$order->add_order_note( sprintf( __( 'Paymill payment completed (Charge ID: %s)', 'wc_paymill' ), $transaction['id'] ) );

				// Add Credit Card Holder Name
				if ( $_POST['account-holder'] ) {
					$order->add_order_note( sprintf( __( 'Holder Name: %s', 'wc_paymill' ), $_POST['cc_name'] ) );
				}

				// Payment complete
				$order->payment_complete();

				// Remove cart
				$woocommerce->cart->empty_cart();

				// Return thank you page redirect
				return array(
					'result'  => 'success',
					'redirect' => $this->get_return_url( $order )
				);

			}

		} catch( Exception $e ) {
			$woocommerce->add_error( __( 'Error:', 'wc_paymill' ) . ' "' . $e->getMessage() . '"' );
			return;
		}

	}

	public function getErrorMessage( $error )
	{
		switch ( $error ) {
			case '10001':
				return __( 'General undefined response', 'wc_paymill' );
				break;

			case '10002':
				return __( 'General success response', 'wc_paymill' );
				break;

			case '40000':
				return __( 'General problem with data', 'wc_paymill' );
				break;

			case '40001':
				return __( 'Problem with credit card data', 'wc_paymill' );
				break;

			case '40100':
				return __( 'General undefined response', 'wc_paymill' );
				break;

			case '40101':
				return __('Problem with cvv.', 'wc_paymill' );
				break;

			case '40102':
				return __('Card expired or not yet valid.', 'wc_paymill' );
				break;

			case '40103':
				return __('Limit exceeded.', 'wc_paymill' );
				break;

			case '40104':
				return __('Card invalid.', 'wc_paymill' );
				break;

			case '40105':
				return __('Expiry date not valid.', 'wc_paymill' );
				break;

			case '40106':
				return __('Credit card brand required.', 'wc_paymill' );
				break;

			case '40200':
				return __('Problem with bank account data.', 'wc_paymill' );
				break;

			case '40201':
				return __('Bank account data combination mismatch.', 'wc_paymill' );
				break;

			case '40202':
				return __('User authentication failed.', 'wc_paymill' );
				break;

			case '40300':
				return __('Problem with 3d secure data.', 'wc_paymill' );
				break;

			case '40301':
				return __('Currency / amount mismatch', 'wc_paymill' );
				break;

			case '40400':
				return __('Problem with input data.', 'wc_paymill' );
				break;

			case '40401':
				return __('Amount too low or zero.', 'wc_paymill' );
				break;

			case '40402':
				return __('Usage field too long.', 'wc_paymill' );
				break;

			case '40403':
				return __('Currency not allowed.', 'wc_paymill' );
				break;

			case '50000':
				return __('General problem with backend.', 'wc_paymill' );
				break;

			case '50001':
				return __('Country blacklisted.', 'wc_paymill' );
				break;

			case '50100':
				return __('Technical error with credit card.', 'wc_paymill' );
				break;

			case '50101':
				return __('Error limit exceeded.', 'wc_paymill' );
				break;

			case '50102':
				return __('Card declined by authorization system.', 'wc_paymill' );
				break;

			case '50103':
				return __('Manipulation or stolen card.', 'wc_paymill' );
				break;

			case '50104':
				return __('Card restricted.', 'wc_paymill' );
				break;

			case '50105':
				return __('Invalid card configuration data.', 'wc_paymill' );
				break;

			case '50200':
				return __('Technical error with bank account.', 'wc_paymill' );
				break;

			case '50201':
				return __('Card blacklisted.', 'wc_paymill' );
				break;

			case '50300':
				return __('Technical error with 3D secure.', 'wc_paymill' );
				break;

			case '50400':
				return __('Decline because of risk issues.', 'wc_paymill' );
				break;

			case '50500':
				return __('General timeout.', 'wc_paymill' );
				break;

			case '50501':
				return __('Timeout on side of the acquirer.', 'wc_paymill' );
				break;

			case '50502':
				return __('Risk management transaction timeout.', 'wc_paymill' );
				break;

			case '50600':
				return __('Duplicate transaction.', 'wc_paymill' );
				break;

			default:
				return __('There was a problem connecting to the payment gateway', 'wc_paymill');
				break;
		}
	}

}
