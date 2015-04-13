<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_Renderer_Group_Position
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $name = '';
        $data = $row->getData($this->getColumn()->getIndex());
        if ($data == 0) {
            $name = 'None';
        } else if ($data == 1) {
            $name = 'Top';
        } else if ($data == 2) {
            $name = 'Left';
        } else if ($data == 3) {
            $name = 'Right';
        } else {
            $name = 'Foot';
        }
        return $name;
    }
}
 