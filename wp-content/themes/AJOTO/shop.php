<?php
	/*
	Template Name: Shop
	*/
 ?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="content" class="<?php echo $post->post_name; ?> products">
		<section class="title small">
			<p>SHOP<span>PURCHASE BEAUTIFUL TOOLS FOR YOUR JOURNEY</span></p>
		</section>
			<header>
				<div class="slideshow"><?php echo get_new_royalslider(get_post_meta($post->ID, 'first', true)); ?></div>
			</header>
					
			<section class="listings" style="margin-bottom:70px;">
				<section class="title mid subhead" id="pen">
					<p>THE PEN<span>WE WANTED TO DO JUSTICE TO THE MOST IMPORTANT TOOL WE USE EVERYDAY. THAT’S WHY WE CREATED A PEN THAT NOT ONLY HAS A GREAT STORY BUT MARkS THE BEGINNING OF A JOURNEY THAT WILL LAST A LIFETIME.<br><br>EACH PEN COMES WRAPPED IN AN ANODISED ALUMINIUM BOX WITH A MOULDED CORk TRAY.</span><a href="../products/the-pen" class="button">FIND OUT MORE</a></p>
				</section>

				<div id="pen"><?php echo do_shortcode( '[products skus="MYM001RAWP,MYM001BP,MYM001SBP,MYM001BSP" orderby="date" order="desc"]' ); ?></div>

				<section class="title mid subhead" id="refills">
					<p>INK REFILLS<span>A PEN IS ONLY AS GOOD AS THE qUALITY OF THE INk IT USES. WE WORk WITH ONE OF THE WORLD’S FINEST REFILL MANUFACTURERS IN THE WORLD TO ENSURE OUR INk IS OF THE HIGHEST STANDARD.</span><a href="../products/the-pen" class="button">FIND OUT MORE</a></p>
		
				</section>
				
				<div id="refills"><?php echo do_shortcode( '[products skus="MYM001RBB,3MYM001RBB"]' ); ?></div>
				
				<section class="title mid subhead" id="pouch">
					<p>THE PEN POUCH<span>THE POUCH IS A BEAUTIFULLY SIMPLE WAY TO STORE AND PROTECT YOUR PEN. A COMBINATION OF EXPERT CRAFTMANSHIP AND THE FINEST TUSCAN VEGETABLE TANNED LEATHER, IT WILL BE YOUR PEN’S PERFECT COMPANION FOR A LIFETIME.</span><a href="../products/the-pen-pouch" class="button">FIND OUT MORE</a></p>
				</section>

				<div id="pouch"><?php echo do_shortcode( '[products skus="MYM001PPLB,MYM001PPB,MYM001PPDB,MYM001PPMB"]' ); ?></div>

				<section class="title mid subhead" id="wallet">
					<p>THE WALLET<span>THE WALLET IS A SIMPLE, TRUSTWORTHY COMPANION THAT CONTAINS THE kEYS TO YOUR WORLD. HANDMADE IN THE Uk FROM TUSCAN LEATHER, WHICH IS VEGETABLE TANNED USING TRADITIONAL PROCESSES DATING BACk 3000 YEARS.</span><a href="../products/the-wallet" class="button">FIND OUT MORE</a></p>
				</section>
			
				<div id="wallet"><?php echo do_shortcode( '[products skus="FTJ001WB,FTJ001WLB,FTJ001WDB"]' ); ?></div>

			</section> <!-- end listings section -->												
		<?php endwhile; ?>									
</div>
<?php endif; ?>
<?php get_footer(); ?>