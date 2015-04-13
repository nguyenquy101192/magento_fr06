<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('items_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('mega_menu')->__('Subcategory Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_item', array(
            'label' => Mage::helper('mega_menu')->__('Subcategory'),
            'title' => Mage::helper('mega_menu')->__('Subcategory'),
            'content' => $this->getLayout()->createBlock('sm_mega_menu/adminhtml_menu_items_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
 