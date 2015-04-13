<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Edit_Tab_Renderer_Slider_Status
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $name = '';
        $status = $row->getData($this->getColumn()->getIndex());
        if ($status == 0) {
            $name = 'Disable';
        } else {
            $name = 'Enable';
        }
        return $name;
    }
}
 