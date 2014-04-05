        <div id="cookiebar" <?php body_class(); ?>>Our website uses cookies so that you can place orders and we can provide a more convenient service.   <a href="../customer-service/#cookies">Find out more</a> | <a id="confirm" href="#">CLOSE</a></div>
        <div id="cart-bar" <?php body_class(); ?>>
            <div id="shopping_cart" class="widget woocommerce widget_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_get_template( 'cart/mini-cart.php' ); ?>
                </div>
            </div>
        </div>
<footer class="footer">
    <div id="footer-bar">
        <div class="nav-box">               
                <a class="top icon-arrow_up" href="">TOP</a>
                <ul class="share">
                    <li><a href="http://www.facebook.com/ajoto" target="_blank"><i class="icon-social_fb"></i></a></li>
                    <li><a href="http://www.flickr.com/ajoto" target="_blank"><i class="icon-social_flkr"></i></a></li>
                    <li><a href="http://instagram.com/ajoto" target="_blank"><i class="icon-social_inst"></i></a></li>
                    <li><a href="http://www.pinterest.com/ajoto" target="_blank"><i class="icon-social_pin"></i></a></li>
                    <li><a href="http://www.twitter.com/ajoto" target="_blank"><i class="icon-social_twitter"></i></a></li>
                    <li><a href="http://www.vimeo.com/ajotostudio" target="_blank"><i class="icon-social_vimeo"></i></a></li>
                </ul>

                <p class="sg"><span>BE CREATIVE</span> <i class="icon-eye"></i> <span>STAY CURIOUS</span></p>
                
                <ul class="meta">
                    <li><a href="../customer-service/#contact" id="other" style="padding-left:0;">Contact Us</a></li>
                    <li><a href="../customer-service/#press" id="press">Press</a></li>
                    <li><a href="../customer-service/#tc" id="ts">Terms &amp; Conditions</a></li>
                    <li><a href="../customer-service/#privacy" id="privacy" style="padding-right:0;">Privacy Policy</a></li>
                    <li><a href="../customer-service/#cookies" id="cookies" style="padding-right:0;">Cookies Information</a></li>
                </ul>
            <p class="copyright">© COPYRIGHT AJOTO LTD. 2014. ALL RIGHTS RESERVED.</p>
            <p class="mark">
                <i class="icon-d_ajoto"></i>
                <i class="icon-d_clover"></i>
                <i class="icon-d_001"></i>
            </p>
        </div>
        </div> <!-- end .footer-bar -->     
</footer> <!-- end footer -->   
    <?php wp_footer(); // js scripts are inserted using this function ?>
</div>

</body>
<!--    <?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.  -->
</html>
