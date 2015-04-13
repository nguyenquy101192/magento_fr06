<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_ProductLabel_Block_Adminhtml_Label_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('label_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('product_label')->__('General Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('product_label')->__('General'),
            'title' => Mage::helper('product_label')->__('General'),
            'content' => $this->getLayout()->createBlock('sm_product_label/adminhtml_label_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
 