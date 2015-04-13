<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_menu'; // call to class grid
        $this->_blockGroup = 'sm_mega_menu';
        $this->_headerText = Mage::helper('mega_menu')->__("Categories");
        $this->_addButtonLabel = Mage::helper('mega_menu')->__('Add Root Category');
        parent::__construct();
    }
}
 