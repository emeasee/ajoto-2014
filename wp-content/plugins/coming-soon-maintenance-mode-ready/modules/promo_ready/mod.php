<?php
class promo_readyCsp extends moduleCsp {
	private $_specSymbols = array(
		'from'	=> array('?', '&'),
		'to'	=> array('%', '^'),
	);
	
	public function init() {
		parent::init();
		add_action('admin_footer', array($this, 'displayAdminFooter'), 9);
		if(is_admin() && !frameCsp::_()->getModule('license')) {
			dispatcherCsp::addFilter('adminOptionsTabs', array($this, 'addPromoTabs'), 99);
		}
		dispatcherCsp::addFilter('adminMenuMainOption', array($this, 'addWelcomePageToMainMenu'), 99);
		dispatcherCsp::addFilter('adminMenuMainSlug', array($this, 'modifyMainAdminSlug'), 99);
	}
	// We used such methods - _encodeSlug() and _decodeSlug() - as in slug wp don't understand urlencode() functions
	private function _encodeSlug($slug) {
		return str_replace($this->_specSymbols['from'], $this->_specSymbols['to'], $slug);
	}
	private function _decodeSlug($slug) {
		return str_replace($this->_specSymbols['to'], $this->_specSymbols['from'], $slug);
	}
	public function decodeSlug($slug) {
		return $this->_decodeSlug($slug);
	}
	public function modifyMainAdminSlug($mainSlug) {
		$firstTimeLookedToPlugin = !installerCsp::isUsed();
		if($firstTimeLookedToPlugin) {
			$mainSlug = $this->_getNewAdminMenuSlug($mainSlug);
		}
		return $mainSlug;
	}
	private function _getWelcomMessageMenuData($option, $modifySlug = true) {
		return array_merge($option, array(
			'page_title'	=> langCsp::_('Welcome to Ready! Ecommerce'),
			'menu_slug'		=> ($modifySlug ? $this->_getNewAdminMenuSlug( $option['menu_slug'] ) : $option['menu_slug'] ),
			'function'		=> array($this, 'showWelcomePage'),
		));
	}
	private function _getNewAdminMenuSlug($menuSlug) {
		// We can't use "&" symbol in slug - so we used "|" symbol
		return 'welcome-to-ready-coming-soon|return='. $this->_encodeSlug($menuSlug);
	}
	public function addWelcomePageToMainMenu($option) {
		$firstTimeLookedToPlugin = !installerCsp::isUsed();
		if($firstTimeLookedToPlugin) {
			$option = $this->_getWelcomMessageMenuData($option, false);
		}
		return $option;
	}
	public function showWelcomePage() {
		$this->getView()->showWelcomePage();
	}
	public function getPromoTemplates() {
		$data = array(
			'csp_tpl_mercury' => array('img' => $this->getModPath(). 'img/csp_tpl_mercury.jpg', 'label' => 'Mercury template'),
			'csp_tpl_myfactory' => array('img' => $this->getModPath(). 'img/csp_tpl_myfactory.jpg', 'label' => 'MyFactory template'),
			'csp_tpl_saenna' => array('img' => $this->getModPath(). 'img/csp_tpl_saenna.jpg', 'label' => 'Saenna template'),
			'csp_tpl_flattern' => array('img' => $this->getModPath(). 'img/csp_tpl_flattern.jpg', 'label' => 'Flattern template'),
		);
		foreach($data as $key => $d) {
			$data[ $key ]['link'] = 'http://readyshoppingcart.com/product/coming-soon-plugin-pro-version/';
		}
		return $data;
	}
	public function displayAdminFooter() {
		if(frameCsp::_()->isAdminPlugPage())
			$this->getView()->displayAdminFooter();
	}
	private function _preparePromoLink($link) {
		$link .= '?ref=user';
		return $link;
	}
	/**
	 * Public shell for private method
	 */
	public function preparePromoLink($link) {
		return $this->_preparePromoLink($link);
	}
	public function addPromoTabs($tabsData) {
		$addTabs = array(
			'cspAweberSetup'        => array('title' => 'Aweber',			'promo' => true, 'sort_order' => 40),
			'cspMailChimpSetup' 	=> array('title' => 'Mail Chimp',		'promo' => true, 'sort_order' => 50),
			'cspContactUsSetup'		=> array('title' => 'Contact Form',		'promo' => true, 'sort_order' => 60),
			'cspGoogleMapsSetup'	=> array('title' => 'Google Maps',		'promo' => true, 'sort_order' => 110),
			'cspStyleEditor'		=> array('title' => 'Style Editor',		'promo' => true, 'sort_order' => 120),
		);
		foreach($addTabs as $tabCode => $tabData) {
			$tabsData[ $tabCode ] = array_merge($tabData, array('content' => $this->getController()->getView()->getPromoTabContent($tabCode, $tabData)));
		}
		return $tabsData;
	}
}