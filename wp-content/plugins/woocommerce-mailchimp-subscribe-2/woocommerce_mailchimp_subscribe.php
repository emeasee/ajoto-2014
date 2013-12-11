<?php
/*
Plugin Name: WooCommerce MailChimp Subscribe
Plugin URI: http://seedprod.com
Description: Allows customers to opt-in for your MailChimp newsletter during checkout with double-opt option.
Version: 1.0.7
Author: SeedProd
Author URI: http://seedprod.com
License: GPLv2
Copyright 2011  John Turner (email : john@seedprod.com, twitter : @johnturner)
*/

// Namespace: wooms

/**
*  Hook into WooCommerce
*/
add_filter('woocommerce_email_settings', 'wooms_email_filter',10,1);
add_action('woocommerce_review_order_before_submit','wooms_add_newsletter_checkbox_to_checkout',99);
add_action('woocommerce_checkout_order_processed','wooms_mailchimp_subscribe_user',10, 2);

/**
*  Inject fields into WooCommerce Email Tab
*/
function wooms_email_filter($fields){
     
    $fields[] = array(  'name' => __( 'MailChimp Integration'), 'type' => 'title', '', 'id' => 'wooms_mailchimp_integration_section' );
    
    $fields[] = array(  
        'name' => __( 'MailChimp API Key', 'wooms'),
        'desc'      => __( 'Enter your API Key. <a href="http://admin.mailchimp.com/account/api-key-popup" target="_blank">Get your API key</a>', 'wooms' ),
        'id'        => 'wooms_mailchimp_api_key',
        'type'      => 'text',
        'css'       => 'min-width:300px;',
    );

    $fields[] = array(  
        'name' => __( 'MailChimp lists', 'wooms'),
        'desc'      => __( 'After you add your MailChimp API Key above and save it this list will be populated.', 'wooms'),
        'id'        => 'wooms_mailchimp_lists',
        'css'       => 'min-width:300px;',
        'type'      => 'select',
        'options'   =>  call_user_func('wooms_get_mailchimp_lists', get_option('wooms_mailchimp_api_key')),
    );

    $fields[] = array(  
        'name' => __( 'Force MailChimp lists refresh', 'wooms' ),
        'desc'      => __( "Check and 'Save changes' this if you've added a new MailChimp list and it's not showing in the list above.", 'wooms' ),
        'id'        => 'wooms_force_refresh',
        'type'      => 'checkbox',
    );

    $fields[] = array(  
        'name' => __( 'Checkout newsletter field label', 'wooms'),
        'desc'      => __( 'This text will be displayed next to the newsletter checkbox at checkout', 'wooms' ),
        'id'        => 'wooms_checkout_newsletter_label',
        'type'      => 'text',
        'std'       => "Yes, I'd like to recieve email updates and special offers!",
        'css'       => 'min-width:300px;',
    );

    $fields[] = array(  
        'name' => __( 'Uncheck Opt-In', 'wooms' ),
        'desc'      => __( "By default the opt-in is checked. This will uncheck it.", 'wooms' ),
        'id'        => 'wooms_mailchimp_uncheck_optin',
        'type'      => 'checkbox',
    );

    $fields[] = array(  
        'name' => __( 'Enable Double Opt-In', 'wooms' ),
        'desc'      => __( "Learn more about <a href='http://kb.mailchimp.com/article/how-does-confirmed-optin-or-double-optin-work' target='_blank'>Double Opt-in</a>.", 'wooms' ),
        'id'        => 'wooms_mailchimp_double_optin',
        'type'      => 'checkbox',
    );

    $fields[] = array(  
        'name' => __( 'Send Welcome Email', 'wooms' ),
        'desc'      => __( "If your Double Opt-in is false and this is true, MailChimp will send your lists Welcome Email if this subscribe succeeds - this will not fire if MailChimp ends up updating an existing subscriber. If Double Opt-in is true, this has no effect. Learn more about <a href='http://blog.mailchimp.com/sending-welcome-emails-with-mailchimp/' target='_blank'>Welcome Emails</a>.", 'wooms' ),
        'id'        => 'wooms_mailchimp_welcome_email',
        'type'      => 'checkbox',
    );

    $fields[] = array(  
        'name' => __( 'Group Name', 'wooms'),
        'desc'      => __( 'Optional: Enter the name of the group. Learn more about <a href="http://mailchimp.com/features/groups/" target="_blank">Groups</a>', 'wooms' ),
        'id'        => 'wooms_mailchimp_group_name',
        'type'      => 'text',
        'css'       => 'min-width:300px;',
    );

    $fields[] = array(  
        'name' => __( 'Groups', 'wooms'),
        'desc'      => __( 'Optional: Comma delimited list of interest groups to add the email to.', 'wooms' ),
        'id'        => 'wooms_mailchimp_groups',
        'type'      => 'text',
        'css'       => 'min-width:300px;',
    );

    $fields[] = array(  
        'name' => __( 'Replace Interests', 'wooms' ),
        'desc'      => __( "Whether MailChimp will replace the interest groups with the groups provided or add the provided groups to the member's interest groups", 'wooms' ),
        'id'        => 'wooms_mailchimp_replace_interests',
        'type'      => 'checkbox',
    );
    


    $fields[] = array( 'type' => 'sectionend', 'id' => 'mailchimp_integration_section' );
 
    return $fields;
}

/**
*  Display Newsletter Checkbox on Checkout
*/
function wooms_add_newsletter_checkbox_to_checkout(){
    $check = get_option('wooms_mailchimp_uncheck_optin');

    if(!empty($check) && $check == 'yes'){
        $is_checked = '';
    }else{
        $is_checked = 'checked="checked"';
    }

    ?>
    <div class="form-row wooms">
        <input type="checkbox" class=".input-checkbox" name="wooms_susbscribe" id="wooms_susbscribe" value="1" <?php echo $is_checked; ?>>
        <label for="wooms_susbscribe" style="display:inline"><span class="wooms_label"><?php echo stripslashes(get_option('wooms_checkout_newsletter_label')); ?></span></label>
    </div>
    <?php
}

/**
*  Subscribe User to MailChimp
*/
function wooms_mailchimp_subscribe_user($order_id,$posted){
    if(!empty($_POST['wooms_susbscribe'])  && $_POST['wooms_susbscribe'] == '1'){
        try{
            require_once 'lib/seed-MCAPI.class.php';
            $apikey = get_option('wooms_mailchimp_api_key');
            $listId = get_option('wooms_mailchimp_lists');
            $mailchimp_groups = get_option('wooms_mailchimp_groups');
            $mailchimp_group_name = get_option('wooms_mailchimp_group_name');
            $email = $posted['billing_email'];

            $merge_vars = array(
                'FNAME' => $posted['billing_first_name'],
                'LNAME' => $posted['billing_last_name'],
                );
            if(!empty($mailchimp_groups) && !empty($mailchimp_group_name)){
                $merge_vars['GROUPINGS'] = array(
                    array('name'=>$mailchimp_group_name, 'groups'=>$mailchimp_groups),
                    );
            }
            if(get_option('wooms_mailchimp_double_optin') == 'yes'){
                $double_optin=true;
            }else{
                $double_optin=false;
            }
            if(get_option('wooms_mailchimp_welcome_email') == 'yes'){
                $welcome_email=true;
            }else{
                $welcome_email=false;
            }
            if(get_option('wooms_mailchimp_replace_interests') == 'yes'){
                $replace_interests=true;
            }else{
                $replace_interests=false;
            }
            $api = new seed_MCAPI($apikey);

            $retval = $api->listSubscribe( $listId, $email, $merge_vars,$email_type='html', $double_optin,true,$replace_interests,$welcome_email);

        } catch (Exception $e) {}
    }
}

/**
*  Get List from MailChimp
*/
function wooms_get_mailchimp_lists($apikey){
    $mailchimp_lists = unserialize(get_transient('wooms_mailchimp_mailinglist'));
    if(empty($mailchimp_lists) || get_option('wooms_force_refresh') == 'yes'){
        require_once 'lib/seed-MCAPI.class.php';
        $apikey = get_option('wooms_mailchimp_api_key');
        $api = new seed_MCAPI($apikey);

        $retval = $api->lists();
        if ($api->errorCode){
            $mailchimp_lists['false'] = __("Unable to load MailChimp lists, check your API Key.", 'wooms');
        } else {
            if ($retval['total'] == 0){
                $mailchimp_lists['false'] = __("You have not created any lists at MailChimp", 'wooms');
                return $mailchimp_lists;
            }   

            foreach ($retval['data'] as $list){
                $mailchimp_lists[$list['id']] = 'MailChimp - '.$list['name'];
            }
            set_transient('wooms_mailchimp_mailinglist',serialize( $mailchimp_lists ),86400);
            update_option('wooms_force_refresh','no');
        }
    }
    return $mailchimp_lists;
}


/**
* Add Dashboard Widget
*/
function wooms_dashboard_widget() {
        $mailchimp_list_stats = unserialize(get_transient('wooms_mailchimp_stats'));
        if(empty($mailchimp_list_stats)){
            require_once 'lib/seed-MCAPI.class.php';
            $apikey = get_option('wooms_mailchimp_api_key');
            $listId = get_option('wooms_mailchimp_lists');
            $api = new seed_MCAPI($apikey);

            $retval = $api->lists($filters = array('list_id'=>$listId));
            $mailchimp_list_stats = $retval['data'][0]['stats'];
            set_transient('wooms_mailchimp_stats',serialize( $mailchimp_list_stats ),86400);
        }
        ?>
        
        <div class="yui3-g">
            <div class="yui3-u-1-5">
                <div class="stat-block secondary-stat-block rounded"> 
                    <p class="label">Subscribers</p> 
                    <div class="stat"><?php echo (empty($mailchimp_list_stats['member_count'])? '0': $mailchimp_list_stats['member_count']) ; ?><span class="small-meta">total</span></div> 
                </div>
            </div>
            <div class="yui3-u-1-5">
                <div class="stat-block secondary-stat-block rounded"> 
                    <p class="label">Avg Sub Rate</p> 
                    <div class="stat"><?php echo (empty($mailchimp_list_stats['avg_sub_rate'])? '0': $mailchimp_list_stats['avg_sub_rate']) ; ?><span class="small-meta">per month</span></div> 
                </div>
            </div>
            <div class="yui3-u-1-5">
                <div class="stat-block secondary-stat-block rounded"> 
                    <p class="label">Avg Unsub Rate</p> 
                    <div class="stat"><?php echo (empty($mailchimp_list_stats['avg_unsub_rate'])? '0': $mailchimp_list_stats['avg_unsub_rate']) ; ?><span class="small-meta">per month</span></div> 
                </div>

            </div>
            <div class="yui3-u-1-5">
                <div class="stat-block secondary-stat-block rounded"> 
                    <p class="label">Avg Open Rate</p> 
                    <div class="stat"><?php echo (empty($mailchimp_list_stats['open_rate'])? '0':round($mailchimp_list_stats['open_rate'])); ?>%<span class="small-meta">per campaign</span></div> 
                </div>
            </div>
            <div class="yui3-u-1-5">
                <div class="stat-block secondary-stat-block rounded"> 
                    <p class="label">Avg Click Rate</p> 
                    <div class="stat"><?php echo (empty($mailchimp_list_stats['click_rate'])? '0': round($mailchimp_list_stats['click_rate'])) ; ?>%<span class="small-meta">per campaign</span></div> 
                </div>
            </div>
        </div>
        <a href="http://mailchimp.com"><img id="wooms-logo" src="<?php echo plugins_url('images/mailchimp-connected-2.png',__FILE__) ; ?>" /></a>
        <?php

} 

// Create the function use in the action hook
function wooms_add_dashboard_widgets() {
    wp_add_dashboard_widget('wooms_dashboard_widget', 'MailChimp List Health', 'wooms_dashboard_widget');   
} 

// Hook into the 'wp_dashboard_setup' action to register our other functions
add_action('wp_dashboard_setup', 'wooms_add_dashboard_widgets' );

// Add Dashboard Styles
function wooms_enqueue($hook) {
    if( $hook != 'index.php')
        return;
    wp_enqueue_style( 'wooms_style', plugins_url('/style.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'wooms_enqueue' );
