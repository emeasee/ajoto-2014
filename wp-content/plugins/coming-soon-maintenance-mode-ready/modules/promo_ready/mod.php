<?php
class promo_readyCsp extends moduleCsp {
	public function init() {
		parent::init();
		add_action('admin_footer', array($this, 'displayAdminFooter'), 9);
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
}