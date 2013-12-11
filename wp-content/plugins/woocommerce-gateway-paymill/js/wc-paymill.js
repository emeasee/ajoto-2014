jQuery(document).ready(function($) {

	var wcPaymillPaymentType = 'creditcard';

	jQuery('body').on('click', '.payment-type', function(e) {
		e.preventDefault();
		wcPaymillSelected = $(this).attr('data-type');

		if ( wcPaymillSelected != wcPaymillPaymentType ) {
			jQuery('#creditcard, #debit').toggle();
			jQuery('.payment-type').toggleClass('alt');
			wcPaymillPaymentType = wcPaymillSelected;
		}
	});

	jQuery('form.checkout').on('checkout_place_order_paymill', function( e ) {
		return wc_paymill_process_card();
	});

	jQuery('form#order_review').submit(function(){
		return wc_paymill_process_card();
	});

	jQuery("form.checkout, form#order_review").on('change', 'cc_name, account-holder, account-number, .bank-code, .card-number, .card-cvc, .card-expiry-month, .card-expiry-year', function( e ) {
		jQuery('.woocommerce_error, .woocommerce_message, .paymill_token').remove();
		jQuery('.paymill_token').remove();
	});

	var $form = jQuery("form.checkout, form#order_review");

	function wc_paymill_process_card() {
		if ( jQuery('#payment_method_paymill').is(':checked') &&  jQuery( 'input.paymill_token' ).size() == 0 ) {
			$form.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.6}});

			if ( wcPaymillPaymentType == 'creditcard' ) {
				paymill.createToken({
					number: jQuery('.card-number').val(),
					cvc: jQuery('.card-cvc').val(),
					exp_month: jQuery('.card-expiry-month').val(),
					exp_year: jQuery('.card-expiry-year').val(),
					currency: jQuery('.pm_currency').val(),
					amount_int: jQuery('.pm_amount').val(),
					cardholdername: jQuery('#billing_first_name').val() +  ' ' + jQuery('#billing_last_name').val()
				}, paymillResponseHandler );
			}

			if ( wcPaymillPaymentType == 'debit' ) {
				paymill.createToken({
					number:        jQuery('.account-number').val(),
					bank:          jQuery('.bank-code').val(),
					accountholder: jQuery('.account-holder').val()
				}, paymillResponseHandler );
			}

			return false;
		}
		return true;
	}

	function paymillResponseHandler( error, result ) {

		if ( error ) {
			console.log(error);
			jQuery('.woocommerce_error, .woocommerce_message, .paymill_token').remove();
			jQuery('.payment_method_paymill').append( '<ul class="woocommerce_error"><li>' + paymillErrorResponse( error.apierror ) + '</li></ul>' );
			$form.unblock();
		} else {
			var token = result.token;
			$form.append("<input type='hidden' class='paymill_token' name='paymill_token' value='" + token + "'/>");
			$form.submit();
		}
	}

	function paymillErrorResponse (errorCode) {
		return wcPaymill[errorCode];
	}
});

