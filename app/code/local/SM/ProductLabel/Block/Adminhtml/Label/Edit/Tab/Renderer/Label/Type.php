<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_ProductLabel_Block_Adminhtml_Label_Edit_Tab_Renderer_Label_Type
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $name = '';
        $data = $row->getData($this->getColumn()->getIndex());
        if ($data == 1) {
            $name = 'New';
        } else if ($data == 2) {
            $name = 'Sale';
        } else if ($data == 3) {
            $name = 'Best Seller';
        } else
            $name = 'Featured';

        return $name;
    }
}