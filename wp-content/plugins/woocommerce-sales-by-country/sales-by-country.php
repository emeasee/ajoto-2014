<?php
/**
* Plugin Name: WooCommerce Sales by Country
* Plugin URI: http://mithu.me/
* Description: Adds a report page to display country specific product sales report.
* Version: 1.0.2
* Author: M.H.Mithu
* Author URI: http://mithu.me/
* License: GNU General Public License v2.0 (or newer)
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
/*  Copyright (C) 2013 M.H.Mithu (Email: mail@mithu.me)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) :

    add_filter('woocommerce_reports_charts', 'sales_by_country');
    function sales_by_country($charts) {
        $charts['sales']['charts']['sales_by_country'] = array(
            'title'       => 'Sales by country',
            'description' => '',
            'function'    => 'wc_country_sales'
        );
        return $charts;
    }

    function wc_country_sales() {

        global $start_date, $end_date, $woocommerce, $wpdb;

        $start_date = isset( $_POST['start_date'] ) ? $_POST['start_date'] : '';
        $end_date    = isset( $_POST['end_date'] ) ? $_POST['end_date'] : '';

        if ( ! $start_date )
            $start_date = date( 'Ymd', strtotime( date('Ym', current_time( 'timestamp' ) ) . '01' ) );
        if ( ! $end_date )
            $end_date = date( 'Ymd', current_time( 'timestamp' ) );

        $start_date = strtotime( $start_date );
        $end_date = strtotime( $end_date );

        $sql = "SELECT country.meta_value AS country_name,
                SUM( order_item_meta.meta_value ) AS sale_total
                FROM {$wpdb->prefix}woocommerce_order_items AS order_items

                LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS order_item_meta
                    ON order_items.order_item_id = order_item_meta.order_item_id

                LEFT JOIN {$wpdb->postmeta} AS country
                    ON order_items.order_id = country.post_id

                LEFT JOIN {$wpdb->posts} AS posts
                    ON order_items.order_id = posts.ID
                
                LEFT JOIN {$wpdb->term_relationships} AS rel ON posts.ID = rel.object_ID
                LEFT JOIN {$wpdb->term_taxonomy} AS tax USING( term_taxonomy_id )
                LEFT JOIN {$wpdb->terms} AS term USING( term_id )

                WHERE posts.post_type             = 'shop_order' 
                AND   posts.post_status           = 'publish'
                AND   order_items.order_item_type = 'line_item'
                AND   order_item_meta.meta_key    = '_line_total'
                AND   country.meta_key            = '_billing_country'
                AND   term.slug IN ('completed','processing','on-hold')
                AND   post_date > '" . date('Y-m-d', $start_date ) . "'
                AND   post_date < '" . date('Y-m-d', strtotime('+1 day', $end_date ) ) . "'
                GROUP BY country.meta_value";

        $result       = $wpdb->get_results($sql, ARRAY_A);
        $country      = new WC_Countries;
        //$eu_countries = $country->get_european_union_countries();
        // echo "<pre>"; var_dump($result); exit();

    ?>
        <form method="post" action="">
            <p><label for="from"><?php _e('From:'); ?></label><input type="text" name="start_date" id="from" readonly="readonly" value="<?php echo esc_attr( date('Y-m-d', $start_date) ); ?>" /><label for="to"><?php _e('To:'); ?></label> <input type="text" name="end_date" id="to" readonly="readonly" value="<?php echo esc_attr( date('Y-m-d', $end_date) ); ?>" /><input type="submit" class="button" value="<?php _e('Show'); ?>" /></p>
        </form>

        <script type="text/javascript">
            jQuery(function(){
                <?php woocommerce_datepicker_js(); ?>
            });
        </script>

        <table class="widefat">
        <thead>
            <tr>
                <th>Country Name</th>
                <th>Sale Total</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Country Name</th>
                <th>Sale Total</th>
            </tr>
        </tfoot>
        <tbody>
    <?php

        foreach($result as $value) {
            //if(in_array($value['country_name'], $country->countries)) { ?>
            <tr>
                <td><?php echo $country->countries[$value['country_name']]; ?></td>
                <td><?php echo get_woocommerce_currency_symbol().$value['sale_total']; ?></td>
            </tr>
    <?php
            // }
        }
    ?>
        </tbody>
        </table>

<?php

    }

else :
    add_action('admin_notices', 'sales_by_country_error_notice');
    function sales_by_country_error_notice(){
        global $current_screen;
        if($current_screen->parent_base == 'plugins'){
            echo '<div class="error"><p>'.__('<strong>WooCommerce Sales by Country</strong> requires <a href="http://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> to be activated in order to work. Please install and activate <a href="'.admin_url('plugin-install.php?tab=search&type=term&s=WooCommerce').'" target="_blank">WooCommerce</a> first.').'</p></div>';
        }
    }

endif;

?>