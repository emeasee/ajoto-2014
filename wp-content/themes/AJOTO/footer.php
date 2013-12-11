        <div id="cookiebar" <?php body_class(); ?>>Our website uses cookies so that you can place orders and we can provide a more convenient service.   <a href="../customer-service/#cookies">Find out more</a> | <a id="confirm" href="#">CLOSE</a></div>
        <div id="cart-bar" <?php body_class(); ?>>
            <div id="shopping_cart" class="widget woocommerce widget_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_get_template( 'cart/mini-cart.php', $args ); ?>
                </div>
            </div>
        </div>
<footer class="footer">
    <div id="footer-bar">
        <div class="nav-box">               
                <a class="top" href="">BACK TO TOP</a>
                <ul class="share">
                    <li><a href="http://www.facebook.com/ajotostudio" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook_l.png" alt=""/></a></li>
                    <li><a href="http://www.twitter.com/ajoto" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter_l.png" alt=""/></a></li>
                    <li><a href="http://www.pinterest.com/ajoto" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/pinterest_l.png" alt=""/></a></li>
                    <li><a href="mailto:studio@ajoto.com" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/email_l.png" alt=""/></a></li>
                </ul>
                
                <ul class="meta">
                    <li><a href="../customer-service/#contact" id="other" style="padding-left:0;">Contact Us</a></li>
                    <li><a href="../customer-service/#press" id="press">Press</a></li>
                    <li><a href="../customer-service/#tc" id="ts">Terms &amp; Conditions</a></li>
                    <li><a href="../customer-service/#privacy" id="privacy" style="padding-right:0;">Privacy Policy</a></li>
                    <li><a href="../customer-service/#cookies" id="cookies" style="padding-right:0;">Cookies Information</a></li>
                </ul>
            <p>© COPYRIGHT AJOTO LTD. 2013. ALL RIGHTS RESERVED.</p>
        </div>
        </div> <!-- end .footer-bar -->     
</footer> <!-- end footer -->   
    <?php wp_footer(); // js scripts are inserted using this function ?>
</body>

</html>
