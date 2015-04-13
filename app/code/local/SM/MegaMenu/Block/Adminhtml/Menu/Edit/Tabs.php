<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('menu_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('mega_menu')->__('Category Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('mega_menu')->__('Category'),
            'title' => Mage::helper('mega_menu')->__('Category'),
            'content' => $this->getLayout()->createBlock('sm_mega_menu/adminhtml_menu_edit_tab_form')->toHtml(),
        ));

        $this->addTab('Items', array(
            'label' => Mage::helper('mega_menu')->__('Subcategory'),
            'title' => Mage::helper('mega_menu')->__('Subcategory'),
            'content' => $this->getLayout()->createBlock('sm_mega_menu/adminhtml_menu_edit_tab_items')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
 