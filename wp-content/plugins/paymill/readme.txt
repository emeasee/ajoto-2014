=== PAYMILL for WordPress ===
Contributors: Matthias Reuter
Donate link: 
Tags: paymill, creditcard, elv, payment, woocommerce, paybutton, ecommerce, debitcard, subscriptions
Requires at least: 3.5
Tested up to: 3.8
Stable tag: 1.5.2
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

With PAYMILL you are able to provide credit card based payments for your customers. German users can use ELV payment, too.

== Description ==

This plugin currently allows:

* Payment Gateway for WooCommerce - incl. subscription support
* Payment Gateway for ShopPlugin
* Pay Button - incl. subscription support

Features in Development:

* Payment Gateway for Magic Members (70% done) - beta for subscriptions included

PAYMILL offers the fastest and easiest way to accept payments online. The innovative payment solution enables online businesses and services to integrate payments into their websites within a very short time. The developer-friendly REST API is flexibly integrable. Customize the check-out process the way you want or use the PAYMILL PayButton which allows an even easier integration. Super-fast account activation within a few days only. Top-notch customer support. Subscriptions supported and Mobile SDKs for iOS and Android available. Accept payments in up to 100 currencies. All major card brands like MasterCard, VISA, American Express, Diner's Club, Maestro etc. supported. Available in 39 countries across Europe so far.

== Installation ==

There is a manual included in English and German as PDF. But in short:

1. Upload `paymill`-directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Register a free account on https://www.paymill.com/
4. Insert TEST Api Keys for testing purposes in plugin settings
5. If you are happy how the plugin works, enable your live account on https://www.paymill.com/ - this could take a couple of days.
6. After your paymill account has been activated for LIVE mode, switch your account to live and replace your TEST API Keys with your LIVE API Keys in plugin settings.

== Frequently asked questions ==

= Is this plugin for free? =

This plugin is for free and licensed to GPL. It's open source following the GPL policy.

= Does this plugin calls to another server? =
Yes. As Pamill is a payment service provider, it is absolutely required to call home to make sure that the payments are valid. We are talking about three different reasons for calling home:

1. PAYMILL Javascript Bridge makes sure that payment data is correct and creates a payment token delivered to your server after checkout. This avoids delivering payment data to your server, what is -in most cases- absolutely prohibited by all common credit card providers.
2. PAYMILL PHP Bridge finishes the order and delivers the generated token to the PAYMILL server.
3. For security purposes we will implement a feature which delivers WordPress version number and PAYMILL Plugin version number upon payment process. This will give us the ability to warn paymill merchants who are using a very outdated WordPress version or about known security holes in specific version when still using them.

= Are there any fees for payments? =

Merchants must create an account on https://www.paymill.com/ to use the payment service. The TEST mode is for free, but there are "per payment" fees in LIVE mode, see https://www.paymill.com/en-gb/pricing/

= Do customers need to create an account for payment? =

No. PAYMILL allows payments without annoying your customers creating an account. They'll just fill out the payment fields on your checkout-page - that's all.

= Does this plugin redirects the users to PAYMILL for payment? =

No. PAYMILL allows payment directly through your website without any extra redirects etc.

= Does this plugin supports 3D secure? =

Yes. Please note that you can test 3D secure feature on LIVE mode only. The TEST mode always gives a positive feedback on 3D secure.

= Which Credit Cards are supported? =

Depending on your country and account status, the following credit card provider are currently supported: VISA, MasterCard, American Express, Diners Club, UnionPay and JCB

= What is ELV and why it's supported? =

ELV is a German banking service and stands for "Elektronisches Lastschriftverfahren". This is a very convenience payment solution for German users, as credit cards are not very common in Germany compared to e.g. USA.

= Can I use shortcodes to display the Pay Button? =

Yes, here's an example shortcode with all currently available parameters: '[paymill_pb title="test title" products_list="1,2"]'

= Are there actions/filters/hooks in the Pay Button? =

Yes, all of them have 1 parameter as array with several vars. You may use var_dump to get their content and structure.

= actions =

* paymill_paybutton_client_created
* paymill_paybutton_client_updated
* paymill_paybutton_subscription_created
* paymill_paybutton_order_complete

= filters =

* paymill_paybutton_order_desc
* paymill_paybutton_email_text

= How can I customize the Pay Button? =

The Pay Button is made for customizing and you should make intensive use of CSS to cutomize it. Examples:

// hide country selection

.paymill_shipping{

    display:none;

}

// hide company name

.paymill_address div:nth-child(2){

    display:none;

}

Additionally, you may want to replace the default order form with your own. Create a
custom theme file on 'THEME_DIR/paymill/pay_button.php' (it will replace '/paymill/lib/tpl/pay_button.php')

== Screenshots ==

1. Common Settings
2. Payment Form
3. Pay Button
4. Pay Button Common Settings
5. Pay Button Products Settings
6. Pay Button Shipping Settings

== Changelog ==

= 1.5.2 =

* Common: "Fatal error: Call to a member function payment_complete() on a non-object" fixed

= 1.5.1 =

* Common: Installation Manual updated
* Common: "Error Multiple Primary Key Defined" on Update fixed
* WooCommerce: Checkout form background color fixed
* WooCommerce: Error "notDigits: '-16045' must contain only digits" fixed
* Pay Button: Submit Button will be hidden on submit (and shown again by error) to avoid double orders.
* Magic Members: Beta available. The B in beta stands for bugs, so please don't use magic members in live environments.

= 1.5.0 =

* Common: Payment processing totally rewritten making it more robust
* Common: Clicking on another area than submit button could submit form - fixed
* Common: Serbo-Croatic Translation added (thanks to Borisa Djuraskovic <borisad@webhostinghub.com>)
* WooCommerce: minor bugfixes
* WooCommerce: More control about visibility of payment icons in checkout form
* Shopplugin: Critical error fixed
* Shopplugin: reworked payment form
* Pay Button: New feature allows redirect to custom thank your URL
* Pay Button: New actions and hooks added for triggering custom functions or customizing order confirmation mail

= 1.4.4 =

* WooCommerce: Rounding issue fixed

= 1.4.3 =

* Common: Minor Fix

= 1.4.2 =

* Common: Critical Fix when using 1.4.1, please update immediately to 1.4.2.

= 1.4.1 =

* Common: Javascript-Handling on Checkout-Process optimized making it more robust
* Common: MASSIVELY improved Error Handling
* Common: Payment Form Design optimized
* Common: Changed Language Pack from en_GB to en_US as this is WordPress' default language
* Pay Button: Subscriptions-Select-Field can be hidden now, too
* Pay Button: Subscriptions Translation Issue fixed on payment form
* Pay Button: Action added: paymill_paybutton_order_complete, args: $order_id, $transaction, $_POST
* Pay Button: Now supports custom theme file on THEME_DIR/paymill/pay_button.php (replaces /paymill/lib/tpl/pay_button.php)
* Pay Button: Now allows hiding certain fields
* Pay Button: Now allows to prevent loading the default styles
* Magic Members: Pre Alpha version included (don't use it except you know what you do!)

= 1.4.0 =

* Subscription support added for WooCommerce Subscriptions addon
* Allows hiding quantity field in pay button widget

= 1.3.2 =

* Creditcard / ELV Switch Display issue fixed
* Translating issues fixed
* WooCommerce Bug on checkout page fixed
* Pay Button show/hide blocks links fixed

= 1.3.1 =

* MasterCard Logo and Payment Bug fixed
* error reporting fixed (thanks to Jan R.)
* notifies with wrong payment data in Pay Button fixed
* credit card button visibility fixed

= 1.3 =

* several PHP notices fixed
* WooCommerce issue fixed (selection of other payment gateway didn't work on checkout page)
* Subscription Support for Pay Button

= 1.2.1 =

* several PHP notices fixed
* incompatibility with Yootheme Cloud Theme (and maybe other themes) fixed
* unsaved Settings for Payment Gateway in WooCommerce fixed
* Payment Type Logo Selection added

= 1.2 =
Shopplugin support added

= 1.1 =
Pay Button added

= 1.0 =
WooCommerce support added

== Upgrade Notice ==

= 1.5.2 =

* Common: "Fatal error: Call to a member function payment_complete() on a non-object" fixed

= 1.5.1 =

* Common: Installation Manual updated
* Common: "Error Multiple Primary Key Defined" on Update fixed
* WooCommerce: Checkout form background color fixed
* WooCommerce: Error "notDigits: '-16045' must contain only digits" fixed
* Pay Button: Submit Button will be hidden on submit (and shown again by error) to avoid double orders.
* Magic Members: Beta available. The B in beta stands for bugs, so please don't use magic members in live environments.

= 1.5.0 =

* Common: Payment processing totally rewritten making it more robust
* Common: Clicking on another area than submit button could submit form - fixed
* Common: Serbo-Croatic Translation added (thanks to Borisa Djuraskovic <borisad@webhostinghub.com>)
* WooCommerce: minor bugfixes
* WooCommerce: More control about visibility of payment icons in checkout form
* Shopplugin: Critical error fixed
* Shopplugin: reworked payment form
* Pay Button: New feature allows redirect to custom thank your URL
* Pay Button: New actions and hooks added for triggering custom functions or customizing order confirmation mail

= 1.4.4 =

* WooCommerce: Rounding issue fixed

= 1.4.3 =

* Common: Minor Fix

= 1.4.2 =

* Common: Critical Fix when using 1.4.1, please update immediately to 1.4.2.

= 1.4.1 =
Maintenance Update with a hugh load of minor improvements and bugfixes

= 1.4.0 =
WooCommerce Subscription Support (beta!), minor improvements

= 1.3.2 =
Several bugs fixed, shortcode support for Pay Button

= 1.3.1 =
Several bugs fixed

= 1.3 =
Several bugs fixed, subscription support added

= 1.2.1 =
Several Bugs fixed and Payment Type Logo Selection added

= 1.2 =
Shopplugin support added

== Missing a feature? ==

Please use the plugin support forum here on WordPress.org. We will add your wished - if realizable - on our todo list. Please note that we can not give any time estimate for that list or any feature request.

= Paid Services =
Nevertheless, feel free to hire the plugin author Matthias Reuter <info@straightvisions.com> if you need to:

* get a customization
* get a feature rapidly / on time
* get a custom WordPress plugin developed to exactly fit your needs.