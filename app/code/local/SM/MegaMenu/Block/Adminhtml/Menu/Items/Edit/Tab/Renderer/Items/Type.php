<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Renderer_Items_Type
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $typeName = '';
        $typeMenu = $row->getData($this->getColumn()->getIndex());
        if ($typeMenu == 1) {
            $typeName = '- Custom Link';
        } else if ($typeMenu == 2) {
            $typeName = '- Category Link By Flat';
        } else if ($typeMenu == 3) {
            $typeName = '- Block Link';
        } else if ($typeMenu == 4) {
            $typeName = '- Category Link By Tree';
        }

        return $typeName;
    }
}
 