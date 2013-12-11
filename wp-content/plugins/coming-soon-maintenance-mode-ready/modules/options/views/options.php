<?php
class optionsViewCsp extends viewCsp {
    public function getAdminPage() {
		$presetTemplatesHtml = $this->getPresetTemplates();
		$tabsData = array(
			'cspMainOptions'		=> array('title' => 'Main',		'content' => $this->getMainOptionsTab()),
			'cspTemplateOptions'	=> array('title' => 'Template', 'content' => $this->getTemplateOptionsTab()),
			'cspPresetTemplates'	=> array('title' => 'Preset Templates', 'content' => $presetTemplatesHtml),

			'cspStyleEditor'=>array('title'=>'Style Editor',"content"=>"",'visible'=>(bool)(bool)frameCsp::_()->getModule('license')),
			'cspContactUsSetup'=>array('title'=>'Contact Form',"content"=>"","visible"=>(bool)frameCsp::_()->getModule('license')),
			'cspGoogleMapsSetup'=>array('title'=>'Google Maps',"content"=>"",'visible'=>(bool)frameCsp::_()->getModule('license')),
			'cspMailChimpSetup'=>array('title'=>'Mail Chimp',"content"=>"",'visible'=>(bool)frameCsp::_()->getModule('license')),
		);
		$tabsData = dispatcherCsp::applyFilters('adminOptionsTabs', $tabsData);
		$this->assign('presetTemplatesHtml', $presetTemplatesHtml);
		$this->assign('tabsData', $tabsData);
        parent::display('optionsAdminPage');
    }
	public function getPresetTemplates() {
		$this->assign('tplModules', frameCsp::_()->getModules(array('type' => 'template')));
		$tplModulesPromo = array();
		if(!frameCsp::_()->getModule('license')) {
			$tplModulesPromo = frameCsp::_()->getModule('promo_ready')->getPromoTemplates();
		}
		$this->assign('tplModulesPromo', $tplModulesPromo);
		return parent::getContent('templatePresetTemplates');
	}
	public function getMainOptionsTab() {
		$generalOptions = $this->getModel()->getByCategories('General');
		if(!isset($this->optModel))
			$this->assign('optModel', $this->getModel());
		$this->assign('allOptions', $generalOptions['opts']);
		return parent::getContent('mainOptionsTab');
	}
	public function getTemplateOptionsTab() {
		$tplOptsData = array(
			'background'	=> array('title' => 'Background',	'content' => $this->getTemplateBgOptionsHtml()),
			'logo'			=> array('title' => 'Logo',			'content' => $this->getTemplateLogoOptionsHtml()),
			'message'		=> array('title' => 'Message',		'content' => $this->getTemplateMsgOptionsHtml()),
		);
		$tplOptsData = dispatcherCsp::applyFilters('adminTemplateOptions', $tplOptsData);
		$this->assign('tplOptsData', $tplOptsData);
		return parent::getContent('templateOptionsTab');
	}
	public function getTemplateBgOptionsHtml() {
		if(!isset($this->optModel))
			$this->assign('optModel', $this->getModel());
		return parent::getContent('templateBgOptionsHtml');
	}
	public function getTemplateLogoOptionsHtml() {
		if(!isset($this->optModel))
			$this->assign('optModel', $this->getModel());
		return parent::getContent('templateLogoOptionsHtml');
	}
	public function getTemplateMsgOptionsHtml() {
		if(!isset($this->optModel))
			$this->assign('optModel', $this->getModel());
		return parent::getContent('templateMsgOptionsHtml');
	}
}
