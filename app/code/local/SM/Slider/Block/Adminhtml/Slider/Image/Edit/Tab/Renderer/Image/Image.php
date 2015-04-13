<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Image_Edit_Tab_Renderer_Image_Image
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $name = $row->getData('image_name');
        $link = $row->getData($this->getColumn()->getIndex());
        $image = "<img src='" . Mage::getBaseUrl('media') . $link . "' alt='" . $name . "' width='100px' height='100px'/>";
        return $image;
    }
}
 