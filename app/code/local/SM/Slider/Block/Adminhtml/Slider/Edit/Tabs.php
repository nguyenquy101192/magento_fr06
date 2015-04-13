<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('slider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('slider')->__('Slideshow Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('slider')->__('General'),
            'title' => Mage::helper('slider')->__('General'),
            'content' => $this->getLayout()->createBlock('sm_slider/adminhtml_slider_edit_tab_form')->toHtml(),
        ));

        $this->addTab('Items', array(
            'label' => Mage::helper('slider')->__('Images'),
            'title' => Mage::helper('slider')->__('Images'),
            'content' => $this->getLayout()->createBlock('sm_slider/adminhtml_slider_edit_tab_image')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
 