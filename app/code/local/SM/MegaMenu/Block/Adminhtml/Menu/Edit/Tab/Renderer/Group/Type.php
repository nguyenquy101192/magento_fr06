<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_Renderer_Group_Type
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $typeName = '';
        $typeGroup = $row->getData($this->getColumn()->getIndex());
        if ($typeGroup == 1) {
            $typeName = 'Vertical';
        } else {
            $typeName = 'Horizontal';
        }

        return $typeName;
    }
}

 