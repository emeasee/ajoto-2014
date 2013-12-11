<?php get_header(); ?>
<div id="container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div id="content" class="single" itemprop="articleBody">	
					<header>
						<?php echo do_shortcode('[gallery size="full" royalslider="43"]'); ?>						
					</header> <!-- end article section -->
					<section class="title">
						<span class="number"><?php echo get_post_meta( $post->ID, 'post-number', true ); ?></span>
						<p class="serif"><?php the_title(); ?></br>
						<span class="sans-serif">SHARE THIS JOURNEY WITH YOUR FRIENDS</span></p>
						<a href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>" class="arrow left"></a><a href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>" class="arrow right"></a>
					</section>
					<section class='mid' style="height:30px;display:block;width:100%;margin-top:-70px;padding:0;">	
					<div class="share">
						<div id="facebook_like_button_holder">
							<fb:like layout="button_count" show_faces="false" width="450" action="recommend"></fb:like>
							<div id="fake_facebook_button"></div>
						</div>						
						<a href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'><img src="<?php echo get_template_directory_uri(); ?>/library/images/pinterest_s.png"/></a>
						<a onClick="MyWindow=window.open('http://twitter.com/home?status=Currently Reading <?php the_title(); ?> (<?php the_permalink(); ?>) @ajoto','MyWindow','width=600,height=400'); return false;" title="Share on Twitter" target="_blank" id="twitter-share"><img src="<?php echo get_template_directory_uri(); ?>/library/images/twitter_s.png"/></a>
						<a href="mailto:?subject=<?php the_title();?>&amp;body=<?php the_permalink() ?>" title="Send this post"><img src="<?php echo get_template_directory_uri(); ?>/library/images/email_s.png"/></a>
					</div>
				</section>
				<section class="screen serif" style="height:auto;">
						<div class="more-less">
							<div class="more-block">
								<p><?php echo get_the_content(); ?>	</p>
							</div>
						</div>				
					<div id="break"></div>
					<p class="sans-serif" style="text-transform:uppercase;">Posted by <?php the_author(); ?></p>
					<p style="font-size: 0.9em;"><?php the_date('jS F Y'); ?></p>
				</section>				
				
				<section class='mid' style="height:30px;padding:0;"></section>
					<nav id="page">				
						<p><?php if(get_adjacent_post(false, '', true)){ ?><span class="prev"><?php previous_post('%','OLDER ENTRY', 'no'); } else { ?><span class="prev light">OLDER ENTRY</span> <?php } ?></span><span class="back"><a href="../journeys" onclick="goBack(event)">BACK</a></span><?php if(get_adjacent_post(false, '', false)){ ?><span class="next"><?php next_post('%','NEWER ENTRY', 'no'); } else { ?><span class="next light">NEWER ENTRY</span><?php } ?></span></p>
					</nav>
			</div> <!-- end #content -->
	<?php endwhile; ?>			
	<?php endif; ?>
</div>
<?php get_footer(); ?>
