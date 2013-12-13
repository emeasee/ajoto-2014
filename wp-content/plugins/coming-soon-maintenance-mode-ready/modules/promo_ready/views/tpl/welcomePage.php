<style type="text/css">
	.spacer {width:100%; height:25px;}
	.container {
		position: relative;
		max-width: 1050px;
	}
	.container h1 {text-align:center; font-size: 30px; margin:10px 0; float: left;}
    .container h2 {font-size:24px; margin:10px 0;}
    .container h3 {font-size:20px; margin:10px 0;}
    .container p {line-height:20px; margin-bottom:10px;}
    .container ul {margin-bottom:10px; margin-left:20px;}
    .container ul li {list-style-type:disc;}
	
	.about-message {
		font-size: 21px;
		line-height: 30px;
		float: left;
	}
	
	.plug-icon-shell {
		position: absolute;
		right: 0;
		top: 50px;
		width: 15%;
	}
	.plug-icon-shell a {
		font-size: 14px;
		color: grey;
		text-decoration: none;
		text-align: right;
		float: right;
	}
	
	.video-wrapper {
		margin:0 auto; 
		width:640px;
		float: left;
	}
    .clear {clear:both;}
    
    .col-3 {
		float:left; 
		padding-right: 20px;
		width:29%;
	}
	
	#toeWelcomePageFindUsForm label {
		line-height: 24px;
		margin-left: 20px;
		font-size: 14px;
		display: block;
		max-width: 200px;
	}
</style>
<script type="text/javascript">
// <!--
jQuery(document).ready(function(){
	jQuery('#toeWelcomePageFindUsForm input[type=radio][name=where_find_us]').change(function(){
		jQuery('#toeFindUsUrlShell, #toeOtherWayTextShell').hide();
		switch(parseInt(jQuery(this).val())) {
			case 4 /*Find on the web*/ :
				jQuery('#toeFindUsUrlShell').show('slow');
				break;
			case 5 /*Other way*/ :
				jQuery('#toeOtherWayTextShell').show('slow');
				break;
		}
	});
	jQuery('#toeWelcomePageFindUsForm').submit(function(){
		jQuery(this).sendFormCsp({
			msgElID: 'toeWelcomePageFindUsMsg'
		,	onSuccess: function(res) {
				if(!res.error) {
					if(res.data.redirect)
						toeRedirect(res.data.redirect);
				}
			}
		});
		return false;
	});
});
// -->
</script>
<div class="container">
	<form id="toeWelcomePageFindUsForm">
		<h1>
			<?php langCsp::_e('Welcome to')?>
			<?php echo CSP_WP_PLUGIN_NAME?>
			<?php langCsp::_e('Version')?>
			<?php echo CSP_VERSION?>!
		</h1>
		<div class="clear"></div>
		<div class="about-message">
			This is first start up of the <?php echo CSP_WP_PLUGIN_NAME?> plugin.<br />
			If you are newbie - check all features on that page, if you are guru - please correct us.
		</div>
		<div class="plug-icon-shell">
			<a target="_blank" href="http://readyshoppingcart.com/product/coming-soon-plugin-pro-version/"><img src="<?php echo $this->getModule()->getModPath(). 'img/plug-icon.png'?>" /></a><br />
			<a target="_blank" href="http://readyshoppingcart.com/product/coming-soon-plugin-pro-version/"><?php echo CSP_WP_PLUGIN_NAME?></a><br />
			<a target="_blank" href="http://readyshoppingcart.com/product/coming-soon-plugin-pro-version/"><?php echo CSP_VERSION?></a><br />
		</div>
		<div class="clear"></div>
		<div class="spacer"></div>

		<h2>Where did you find us?</h2>
		<?php foreach($this->askOptions as $askId => $askOpt) { ?>
			<label><?php echo htmlCsp::radiobutton('where_find_us', array('value' => $askId))?>&nbsp;<?php echo $askOpt['label']?></label>
			<?php if($askId == 4 /*Find on the web*/) { ?>
				<label id="toeFindUsUrlShell" style="display: none;">Please, post url: <?php echo htmlCsp::text('find_on_web_url')?></label>
			<?php } elseif($askId == 5 /*Other way*/) { ?>
				<label style="display: none;" id="toeOtherWayTextShell"><?php echo htmlCsp::textarea('other_way_desc')?></label>
			<?php }?>
		<?php }?>

		<div class="spacer"></div>

		<h2>Video tutorial</h2>
		<div class="video-wrapper">
			<iframe width="640" height="360" src="//www.youtube.com/embed/kIRh4oCvv6I" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="clear"></div>
		
		<div class="about-message">What to do next? Check below section:</div>
		<div class="clear"></div>
		
		<div class="col-3">
			<h3>Boost us:</h3>
			<p>It's amazing when you boost development with your feedback and ratings. So we create special <a target="_blank" href="http://readyshoppingcart.com/boost-our-plugins/">boost page</a> to help you to help us.</p>
		</div>

		<div class="col-3">
			<h3>Documentation:</h3>
			<p>Check <a target="_blank" href="http://readyshoppingcart.com/product/coming-soon-plugin-pro-version/">documentation</a> and FAQ section. If you can't solve your problems - <a target="_blank" href="http://readyshoppingcart.com/contacts/">contact us</a>.</p>
		</div>

		<div class="col-3">
			<h3>Full Features List:</h3>
			<p>There are so many features, so we can't post it here. Like:</p>
			<ul>
				<li>Works with any WordPress Theme</li>
				<li>Build with HTML5 & CSS3</li>
				<li>Responsive. Work on any device</li>
				<li>Access controls (Restrict By User Role, IP Address)</li>
				<li>Social integration (Facebook, Tweeter, Google+, YouTube, Instagram)</li>
			</ul>
			<p>So check full features list <a target="_blank" href="http://wordpress.org/plugins/coming-soon-maintenance-mode-ready/">here</a>.</p>
		</div>
		<div class="clear"></div>

		<?php echo htmlCsp::hidden('page', array('value' => 'promo_ready'))?>
		<?php echo htmlCsp::hidden('action', array('value' => 'welcomePageSaveInfo'))?>
		<?php echo htmlCsp::hidden('reqType', array('value' => 'ajax'))?>
		<?php echo htmlCsp::submit('gonext', array('value' => 'Thank for check info. Start using plugin.', 'attrs' => 'class="button button-primary button-hero"'))?>
		<?php echo htmlCsp::hidden('original_page', array('value' => reqCsp::getVar('page')))?>
		
		<span id="toeWelcomePageFindUsMsg"></span>
	</form>
</div>