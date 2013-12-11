<?PHP
	// $license = (bool)frameCsp::_()->getModule('license');
	// var_dump($license);exit;
?>
<div id="cspAdminOptionsTabs">
    <h1>
        <?php langCsp::_e('Ready! Coming Soon plugin')?>
        <?php //langCsp::_e('version')?>
        <!--[<?php //echo CSP_VERSION?>]-->
    </h1>
	<ul>
		<?php foreach($this->tabsData as $tId => $tData) { 
			
		?>
		<li class="<?php echo $tId?>"><a href="#<?php echo $tId ?>"><?php langCsp::_e($tData['title'])?></a><?PHP if(isset($tData['visible']) && !$tData['visible']){
								echo "<small>Pro Feature</small>";
							}?> </li>
		<?php }?>
	</ul>
	<?PHP
		
	?>
	<?php foreach($this->tabsData as $tId => $tData) { ?>
	<div id="<?php echo $tId?>">
		<?php 
			if(isset($tData['visible']) && !$tData['visible']){
				echo "<div><a>For more information: <a href='			http://readyshoppingcart.com/product/coming-soon-plugin-pro-version/' target='_blank'>check all PRO options</a></div>";				
			}else{
			echo $tData['content'];

			} ?></div>
	<?php }?>
</div>
<div id="cspAdminTemplatesSelection"><?php echo $this->presetTemplatesHtml?></div>
