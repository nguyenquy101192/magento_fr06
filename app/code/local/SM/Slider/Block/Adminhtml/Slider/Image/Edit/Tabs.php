<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Image_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('image_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('slider')->__('Item Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_item', array(
            'label' => Mage::helper('slider')->__('General'),
            'title' => Mage::helper('slider')->__('General'),
            'content' => $this->getLayout()->createBlock('sm_slider/adminhtml_slider_image_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
 