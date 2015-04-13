<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Renderer_Items_Parent
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $parentId = $row->getData($this->getColumn()->getIndex());
        $listMenu = Mage::getModel('menu/items')->getCollection()->getData();

        if ($parentId == 0) {
            $parentName = 'Root';
        } else {
            $parentName = $this->getChildMenu($parentId, $listMenu);
        }

        return $parentName;
    }

    protected function getChildMenu($parentId, $array = array())
    {
        $name = " ";
        foreach ($array as $key => $value) {
            if ($parentId == $value['menu_id'])
                $name = $value['menu_name'];
        }
        return $name;
    }
}
