<?php
class adminmenuViewCsp extends viewCsp {
    protected $_file = '';
    /**
     * Array for standart menu pages
     * @see initMenu method
     */
    protected $_mainSlug = 'ready-coming-soon-page';
    public function init() {
        $this->_file = __FILE__;
		//$this->_options = dispatcherCsp::applyFilters('adminMenuOptions', $this->_options);
        add_action('admin_menu', array($this, 'initMenu'), 9);
        parent::init();
    }
    public function initMenu() {
        add_menu_page(langCsp::_('Ready! Coming Soon'), langCsp::_('Ready! Coming Soon'), 10, $this->_mainSlug, array(frameCsp::_()->getModule('options')->getView(), 'getAdminPage'));
    }
    public function getFile() {
        return $this->_file;
    }
	public function getMainSlug() {
		return $this->_mainSlug;
	}
    /*public function getOptions() {
        return $this->_options;
    }*/
}