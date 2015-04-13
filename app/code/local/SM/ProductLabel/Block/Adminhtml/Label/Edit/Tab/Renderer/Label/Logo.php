<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_ProductLabel_Block_Adminhtml_Label_Edit_Tab_Renderer_Label_Logo
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $name = $row->getData('label_name');
        $link = $row->getData($this->getColumn()->getIndex());
        $image = "<img src='" . Mage::getBaseUrl('media') . $link . "' alt='" . $name . "' width='80px' height='80px'/>";
        return $image;
    }
}