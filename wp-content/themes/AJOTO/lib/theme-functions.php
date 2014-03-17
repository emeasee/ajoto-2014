<?php

/****************************************
Backend Functions
*****************************************/

/**
 * Customize Contact Methods
 * @since 1.0.0
 *
 * @author Bill Erickson
 * @link http://sillybean.net/2010/01/creating-a-user-directory-part-1-changing-user-contact-fields/
 *
 * @param array $contactmethods
 * @return array
 */
function mb_contactmethods( $contactmethods ) {
	unset( $contactmethods['aim'] );
	unset( $contactmethods['yim'] );
	unset( $contactmethods['jabber'] );

	return $contactmethods;
}

/**
 * Register Widget Areas
 */
function mb_widgets_init() {

	// Shopping Cart
     register_sidebar(array(
    	'id' => 'cart',
    	'name' => 'Shopping Cart',
    	'description' => 'The shopping cart of the user',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
}

/**
 * Don't Update Theme
 * @since 1.0.0
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
function mb_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}

/**
 * Remove Dashboard Meta Boxes
 */
function mb_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

/**
 * Change Admin Menu Order
 */
function mb_custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	return array(
		// 'index.php', // Dashboard
		// 'separator1', // First separator
		// 'edit.php?post_type=page', // Pages
		// 'edit.php', // Posts
		// 'upload.php', // Media
		// 'gf_edit_forms', // Gravity Forms
		// 'genesis', // Genesis
		// 'edit-comments.php', // Comments
		// 'separator2', // Second separator
		// 'themes.php', // Appearance
		// 'plugins.php', // Plugins
		// 'users.php', // Users
		// 'tools.php', // Tools
		// 'options-general.php', // Settings
		// 'separator-last', // Last separator
	);
}

/**
 * Hide Admin Areas that are not used
 */
function mb_remove_menu_pages() {
	// remove_menu_page('link-manager.php');
}

/**
 * Remove default link for images
 */
function mb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}

/**
 * Show Kitchen Sink in WYSIWYG Editor
 */
function mb_unhide_kitchensink($args) {
	$args['wordpress_adv_hidden'] = false;
	return $args;
}

/****************************************
Frontend
*****************************************/

/**
 * Enqueue scripts
 */
function mb_scripts() {
	// CSS first
	wp_register_style('mb_style', get_stylesheet_directory_uri().'/style.css', null, '1.0', 'all' );
	wp_enqueue_style( 'mb_style' );
	// JavaScript
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( !is_admin() ) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.6.2.min.js', false, NULL );
		wp_enqueue_script('customplugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array('jquery'), NULL, true );
		wp_enqueue_script('froogaloop', get_template_directory_uri() . '/assets/js/vendor/froogaloop/froogaloop2.min.js', array('jquery'), NULL, true );
		wp_enqueue_script('masonry', get_template_directory_uri() . '/assets/js/vendor/masonry.pkgd.min.js', array('jquery'), NULL, true );
		wp_enqueue_script('customscripts', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), NULL, true );
	}
}

/**
 * Remove Query Strings From Static Resources
 */
function mb_remove_script_version($src){
	$parts = explode('?', $src);
	return $parts[0];
}

/**
 * Remove Read More Jump
 */
function mb_remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}

/**
 * Royal Slider Theme Dark
 */

add_filter('new_royalslider_skins', 'new_royalslider_add_custom_skin', 10, 2);
function new_royalslider_add_custom_skin($skins) {
      $skins['rsDefaultBlack'] = array(
           'label' => 'Default on Light',
           'path' =>  get_template_directory_uri() . '/assets/scss/default-black/rs-default-black.css'
      );
      return $skins;
}

/**
 * Producer Map Custom v1
 */

function plot_pin( $title, $x, $y, $side ){ ?>
        <span class="pin" style="position:absolute;top:<?php echo $y; ?>px;left:<?php echo $x; ?>px"></span>
<?php }

function build_map( $product ){ ?>
        <div class="pins">
                <?php   
                        $args = array( 
                            'post_type' => 'suppliers', 
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'custom_cat2',
                                     'terms' => $product,
                                     'posts_per_page'=>-1,
                                     'field' => 'slug',
                                     'nopaging' => true
                                    )) );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post(); 
                            $id = $loop->post->ID;
                            $title = $loop->post->post_title;
                            $cats_obj = get_the_terms($id,'custom_cat');
                            $tags_obj = get_the_terms($id,'custom_tag');
                            // Retrieves the stored values from the database
                            $address1 = get_post_meta( $id, 'address-1', true );
                            $address2 = get_post_meta( $id, 'address-2', true );
                            $city = get_post_meta( $id, 'city', true );
                            $postcode = get_post_meta( $id, 'postcode', true );
                            $country = get_post_meta( $id, 'country', true );
                            $website = get_post_meta( $id, 'website', true );
                            $contact = get_post_meta( $id, 'contact', true );
                            $phone = get_post_meta( $id, 'phone', true );
                            $email = get_post_meta( $id, 'email', true );
                            $x = get_post_meta( $id, 'posx', true );
                            $y = get_post_meta( $id, 'posy', true ); 
                            $side = get_post_meta( $id, 'side', true ); ?>
                        <div id="pin-<?php echo $id ?>" class="pin-container">
                            <?php plot_pin($loop->post->post_title, $x, $y, $side); ?>                    
                            <div class="info">
                                <div class="bg"></div>
                                <div class="box">  
                                    <h2 class="title"><?php echo $title; ?></h2>
                                    <div class="contact">
                                        ADDRESS:<br/>
                                        <?php if (!empty($address1)) {echo $address1 . '<br/>';} ?>
                                        <?php if (!empty($address2)) {echo $address2 . '<br/>';} ?>
                                        <?php if (!empty($city)) {echo $city . '<br/>';} ?>
                                        <?php if (!empty($postcode)) {echo $postcode . ', ';} ?>
                                        <?php if (!empty($country)) {echo $country . '<br/>';} ?>
                                        <br/>
                                        WEBSITE:<br/>
                                        <?php if (!empty($website)) {echo $website . '<br/>';} ?>
                                        <br/>
                                        CONTACT:<br/>
                                        <?php if (!empty($contact)) {echo $contact . '<br/>';} ?>
                                        <br/>
                                        PHONE:<br/>
                                        <?php if (!empty($phone)) {echo $phone . '<br/>';} ?>
                                    </div>
                                    <div class="cats">
                                        PART:<br/>
                                        <?php foreach ($cats_obj as $cat) :
                                            echo $cat->name . '<br/>';
                                         endforeach; ?>
                                        <br/>
                                        PROCESS:<br/>
                                        <?php foreach ($tags_obj as $tag) :
                                            echo $tag->name . '<br/>';
                                         endforeach; ?>
                                    </div>
                                    <div class="img"><?php the_post_thumbnail('full'); ?></div>
                                </div>
                                <div class="close">CLOSE</div>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_postdata();?>
        </div>
<?php }

/**
 * Twitter Feed 
 */

function twitterFeed( $number ){
    $tweets = getTweets($number,'ajoto');//change number up to 20 for number of tweets
    
    echo "<div class='twitter_div'>
            <ul class='twitter_update_list'>"; 

    if(is_array($tweets)){
        foreach($tweets as $tweet){

            if($tweet['text']){
                $the_tweet = $tweet['text'];

                if(is_array($tweet['entities']['user_mentions'])){
                    foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
                    $the_tweet = preg_replace(
                        '/@'.$user_mention['screen_name'].'/i',
                        '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>', $the_tweet);
                        }
                }
            if(is_array($tweet['entities']['hashtags'])){
                foreach($tweet['entities']['hashtags'] as $key => $hashtag){
                    $the_tweet = preg_replace(
                        '/#'.$hashtag['text'].'/i',
                        '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
                        $the_tweet);
                }
            }
            if(is_array($tweet['entities']['urls'])){
                foreach($tweet['entities']['urls'] as $key => $link){
                    $the_tweet = preg_replace(
                        '`'.$link['url'].'`',
                        '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
                        $the_tweet);
                }
            }
             echo "<li><span>".$the_tweet."</span><a style='font-size:85%' href='http://twitter.com/ajoto' target='_blank' class='twitterdatelink'>@ajoto</a></li>";    
            }
        }
    }
    echo "</ul></div>";
}

/**
 * Currency Converter Custom v1
 */

add_action('my_hourly_event', 'refreshCurrencies');
function my_activation() {
    if ( !wp_next_scheduled( 'my_hourly_event' ) ) {
        wp_schedule_event( current_time( 'timestamp' ), 'hourly', 'my_hourly_event');
    }
}
add_action('wp', 'my_activation');

function refreshCurrencies(){
    $url = "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
    copy($url, get_template_directory() . "/lib/rates.xml");
}

function createdTime(){
    $theme_root = get_template_directory();
    $filename = get_template_directory() . '/lib/rates.xml';
    if (file_exists($filename)) {
        echo "<br/><br/>Rates last updated: <br/>" . date ("F d Y H:i", filemtime($filename));
    }
}

// Realtime currency converter by Pixel Envision (E.Gonenc)
function currency_convert($from,$to,$amount,$sign=true,$sensitivity=2) {
$RATES=$BASE=$in=$out=$append=NULL;
//Array of available countries & currencies
$CURRENCY=array("US"=>"USD","BE"=>"EUR","ES"=>"EUR","LU"=>"EUR","PT"=>"EUR","DE"=>"EUR","FR"=>"EUR","MT"=>"EUR","SI"=>"EUR","IE"=>"EUR","IT"=>"EUR","NL"=>"EUR","SK"=>"EUR","GR"=>"EUR","CY"=>"EUR","AT"=>"EUR","FI"=>"EUR","JP"=>"JPY","BG"=>"BGN","CZ"=>"CZK","DK"=>"DKK","EE"=>"EEK","GB"=>"GBP","HU"=>"HUF","LT"=>"LTL","LV"=>"LVL","PL"=>"PLN","RO"=>"RON","SE"=>"SEK","CH"=>"CHF","NO"=>"NOK","HR"=>"HRK","RU"=>"RUB","TR"=>"TRY","AU"=>"AUD","BR"=>"BRL","CA"=>"CAD","CN"=>"CNY","HK"=>"HKD","ID"=>"IDR","IN"=>"INR","KR"=>"KRW","MX"=>"MXN","MY"=>"MYR","NZ"=>"NZD","PH"=>"PHP","SG"=>"SGD","TH"=>"THB","ZA"=>"ZAR");
if (strlen($from)==2 && strlen($to)==2) {//Operate using country code
    if(isset($CURRENCY[$from])) {$in=$CURRENCY[$from];}
    if(isset($CURRENCY[$to])) {$out=$CURRENCY[$to];}
} elseif (strlen($from)==3 && strlen($to)==3) {//Operate using currency code
    if(in_array($from,$CURRENCY)) {$in=$from;}
    if(in_array($to,$CURRENCY)) {$out=$to;}
} else {
    echo "Error: You should either use 2 digit country codes or 3 digit currency codes!";
}

    if ($in && $out) {//Both currencies available, continue
    
        //Load live conversion rates and set as an array
        $theme_root = get_template_directory();
        $XMLContent= file($theme_root . "/lib/rates.xml");      
        if(is_array($XMLContent)) {
            foreach ($XMLContent as $line) {
                    if (preg_match("/currency='([[:alpha:]]+)'/",$line,$currencyCode)) {
                        if (preg_match("/rate='([[:graph:]]+)'/",$line,$rate)) {
                                $RATES[$currencyCode[1]]=$rate[1];
                        }
                    }
            }
        }
        if(is_array($RATES)) {
            
        $RATES["EUR"]=1; //Add EUR reference to array
        if ($in!="EUR") {//Normalize rate to given input
        $BASE=$RATES[$in];
        foreach ($RATES as $code => $rate) {
            $RATES[$code]=round($rate/$BASE,$sensitivity);}
        }

        //Prepend or append the currency information
        if ($sign) {
            if ($out=="USD") {echo "$";}
            elseif ($out=="EUR") {echo "€";}
            elseif ($out=="GBP") {echo "£";}
            elseif ($out=="JPY") {echo "¥";}
            else {$append=$out;}
        }
        
        $newamount = $amount*$RATES[$out];//Output the converted amount
        
        echo number_format(floor($newamount*pow(10,$sensitivity))/pow(10,$sensitivity),$sensitivity);

        if ($append) {echo " ".$append;}

        } else {
            echo "Error: Unable to load conversion rates!"; 
        }
    
    } else {
        echo "£".$amount; 
    }
}


function get_exchange_rate() {
	$to = $_POST['currselect'];
	$amount = $_POST['amount'];
	$from = "GBP";
	
	$amount = preg_replace("/[^0-9,.]/", "", $amount);
	$amount = floatval($amount);
    
    $result = currency_convert($from,$to,$amount);
    die($result);
}



add_action( 'wp_ajax_nopriv_get_exchange_rate', 'get_exchange_rate' );  
add_action( 'wp_ajax_get_exchange_rate', 'get_exchange_rate' );  

/**
 * Woocommerce Hooks and Filters
 */

// Remove Woocommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function my_filer_function( $message )
{
    
   $message = 'Products successfully added to your cart. <a href="../cart">Go to Checkout ></a>';
   
    return $message;
}
// Then add the function to that filter hook and prioritize it last
add_filter( 'woocommerce_add_to_cart_message', 'my_filer_function', 999);

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
 
function custom_override_checkout_fields( $fields ) {
     $fields['account']['account_username']['placeholder'] = '* Username/Email Address';
     $fields['account']['account_password']['placeholder'] = '* Password';
     $fields['account']['account_password-2']['placeholder'] = '* Confirm Password';

     $fields['billing']['billing_first_name']['placeholder'] = '* First Name';
     $fields['billing']['billing_last_name']['placeholder'] = '* Last Name';
     $fields['billing']['billing_company']['placeholder'] = 'Company Name';
     $fields['billing']['billing_address_1']['placeholder'] = '* Street Address';
     $fields['billing']['billing_city']['placeholder'] = '* Town / City';
     $fields['billing']['billing_postcode']['placeholder'] = '* Postcode / Zip';
     $fields['billing']['billing_country']['label'] = 'Required';
     $fields['billing']['billing_state']['placeholder'] = 'State / County';
     $fields['billing']['billing_email']['placeholder'] = '* E-mail';
     $fields['billing']['billing_phone']['placeholder'] = '* Phone Number';
     
     $fields['shipping']['shipping_first_name']['placeholder'] = '* First Name';
     $fields['shipping']['shipping_last_name']['placeholder'] = '* Last Name';
     $fields['shipping']['shipping_company']['placeholder'] = 'Company Name';
     $fields['shipping']['shipping_address_1']['placeholder'] = '* Street Address';
     $fields['shipping']['shipping_city']['placeholder'] = '* Town / City';
     $fields['shipping']['shipping_postcode']['placeholder'] = '* Postcode / Zip';
     $fields['shipping']['shipping_country']['label'] = 'Required';
     $fields['shipping']['shipping_state']['placeholder'] = 'State / County';
     $fields['shipping']['shipping_email']['placeholder'] = '* E-mail';
     $fields['shipping']['shipping_phone']['placeholder'] = '* Phone Number';
    
   
     return $fields;
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 **/

 if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail('medium',150,150);
    } 
 }

 /**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
    
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
        global $post, $woocommerce;

        if ( ! $placeholder_width )
            $placeholder_width = $woocommerce->get_image_size( 'shop_catalog_image_width' );
        if ( ! $placeholder_height )
            $placeholder_height = $woocommerce->get_image_size( 'shop_catalog_image_height' );
            
            $output = '<div class="imagewrapper">';

            if ( has_post_thumbnail() ) {
                
                $output .= get_the_post_thumbnail( $post->ID, $size ); 
                
            } else {
            
                $output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
            
            }
            
            $output .= '</div>';
            
            return $output;
    }
 }

  /**
 * WooCommerce AJAX Cart
 **/

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    
    ob_start();
    
    ?>
    <a class="cart-contents sans-serif" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart"><?php _e('BASKET', 'woocommerce'); ?><?php echo sprintf(_n(' (%d)', ' (%d)', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?><strong class="am" id="<?php echo $woocommerce->cart->subtotal; ?>"> - <?php echo $woocommerce->cart->get_cart_total(); ?></strong></a>
    <?php
    
    $fragments['a.cart-contents'] = ob_get_clean();
    
    return $fragments;
    
 } 

  /**
 * WooCommerce Availability Override
 **/

add_filter( 'woocommerce_get_availability', 'custom_override_get_availability', 1, 2);

function custom_override_get_availability( $availability, $_product ) {
if ( $_product->is_in_stock() ) $availability['availability'] = __('', 'woocommerce');
return $availability;
}

