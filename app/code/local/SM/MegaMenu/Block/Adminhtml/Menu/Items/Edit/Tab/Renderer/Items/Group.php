<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Renderer_Items_Group
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $arr = array();
        $groupId = $row->getData($this->getColumn()->getIndex());
        $groupName = Mage::getModel('menu/menu')->getCollection()->addFieldToFilter('group_id', $groupId)->getData();

        foreach ($groupName as $value) {
            $arr[] = $value['group_name'];
        }
        $arr = implode(', ', $arr);
        return $arr;
    }
}
 