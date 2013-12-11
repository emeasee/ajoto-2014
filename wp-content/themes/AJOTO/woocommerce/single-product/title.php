<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<?php if ( get_post_meta( get_the_ID(), 'title', true) ) { ?>
        <div class="slideshow"><?php echo get_new_royalslider(get_post_meta(get_the_ID(), 'title', true)); ?></div>
<?php } ?>
