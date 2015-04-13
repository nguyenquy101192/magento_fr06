<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_ProductLabel_Block_Adminhtml_Label extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_label'; // call to class grid
        $this->_blockGroup = 'sm_product_label';
        $this->_headerText = Mage::helper('product_label')->__("Manage Product Label");
        $this->_addButtonLabel = Mage::helper('product_label')->__('Add New Label');
        parent::__construct();
    }
}