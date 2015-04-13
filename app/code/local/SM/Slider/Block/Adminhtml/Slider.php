<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_slider'; // call to class grid
        $this->_blockGroup = 'sm_slider';
        $this->_headerText = Mage::helper('slider')->__("Manage Slider");
        $this->_addButtonLabel = Mage::helper('slider')->__('Add new slider');
        parent::__construct();
    }
}
 