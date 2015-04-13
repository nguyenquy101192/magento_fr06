<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Items extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('menu/items');
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();

        /*
                 * split array list category to string.
                */
        $data = $this->getData('list_item');
        if ($data != null) {
            $data = implode(",", $data);
            $this->setData('menu_type_item', $data);
        } else {
            $data = '';
            $this->setData('menu_type_item', $data);
        }

        /*
                 *  set data if choose category by tree
                 */

        $category = $this->getData('show_by_tree');

        if ($category != null) {
            $category = implode(",", $category);
            $this->setData('menu_type_item', $category);
            $this->setData('show_by_tree', 1);
        } else {
            $category = '';
            $this->setData('show_by_tree', $category);
        }

        /*
                 *
                 *   set level for menu item
                 */
        if ($this->getData('parent_id') == 0) {
            $this->setData('level', 1);
        } else {
            $parentId = $this->getData('parent_id');
            $levelParentMenu = Mage::getSingleton('menu/items')
                ->getCollection()
                ->addFieldToSelect('level')
                ->addFieldToFilter('menu_id', $parentId)
                ->getData();
            $this->setData('level', $levelParentMenu[0]['level'] + 1);
        }

        return $this;
    }
}