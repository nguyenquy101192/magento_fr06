<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Renderer_Items_Url
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $urlName = '';
        $url = $row->getData($this->getColumn()->getIndex());
        if ($url == null) {
            $urlName = "None";
        } else {
            $urlName = $url;
        }
        return $urlName;
    }
}