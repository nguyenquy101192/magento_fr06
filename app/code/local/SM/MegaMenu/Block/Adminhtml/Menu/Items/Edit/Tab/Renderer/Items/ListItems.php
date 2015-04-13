<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Renderer_Items_ListItems
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $string = '';
        $type = $row->getData('menu_type');
        $listItems = $row->getData($this->getColumn()->getIndex());
        $listItems = explode(",", $listItems);

        if ($type == 2) {
            $listCategories = Mage::getModel('catalog/category')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('is_active', '1')
                ->addAttributeToFilter('include_in_menu', '1')
                ->addAttributeToFilter('entity_id', array('in' => $listItems))
                ->load();
            foreach ($listCategories as $key => $value) {
                $string .= "- " . $value->getName() . "<br/>";
            }
        } else if ($type == 3) {
            $listBlocks = Mage::getResourceModel('cms/block_collection')
                ->AddFieldToFilter('block_id', $listItems)
                ->getData();
            foreach ($listBlocks as $key => $value) {
                $string .= "- " . $value['title'] . "<br/>";
            }
        } else if ($type == 4) {
            $listCategories = Mage::getModel('catalog/category')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('is_active', '1')
                ->addAttributeToFilter('include_in_menu', '1')
                ->addAttributeToFilter('entity_id', array('in' => $listItems))
                ->load();
            foreach ($listCategories as $key => $value) {
                $string .= "- " . $value->getName() . "<br/>";
            }
        } else {
            $string = '- No items';
        }

        return $string;
    }
}
 