<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Source_Group
{
    public function getGroupId()
    {
        $groupId = Mage::app()->getRequest()->getParam('group_id');
        return $groupId;
    }

    public function getGroupName()
    {
        $groupId = Mage::app()->getRequest()->getParam('group_id');
        $listGroup = Mage::getModel('menu/menu')
            ->getCollection()
            ->addFieldToSelect('group_id')
            ->addFieldToSelect('group_name')
            ->addFieldToFilter('group_id', $groupId)
            ->getData();

        $groupName = array();
        $groupName[$groupId] = $listGroup[0]['group_name'];
        return $groupName;
    }

    public function getListMenu()
    {
        $groupId = Mage::app()->getRequest()->getParam('group_id');
        $id = Mage::app()->getRequest()->getParam('id');

        if ($id != null) {
            $childrenMenu = array();
            $childrenMenu = $this->getChildrenMenu($id);
            $childrenMenu[] = $id;
            $listMenu = Mage::getModel('menu/items')
                ->getCollection()
                ->addFieldToFilter('group_id', $groupId)
                ->addFieldToFilter('menu_id', array('nin' => $childrenMenu))
                ->getData();
        } else {
            $listMenu = Mage::getModel('menu/items')
                ->getCollection()
                ->addFieldToFilter('group_id', $groupId)
                ->getData();
        }

        $array = array('0' => 'Root');
        foreach ($listMenu as $value) {
            if ($value['menu_type'] == 1) {
                $array[$value['menu_id']] = $value['menu_name'];
            }
        }

        return $array;
    }

    public function isHasChild()
    {
        $flag = false;
        $itemId = Mage::app()->getRequest()->getParam('id');
        $groupId = Mage::app()->getRequest()->getParam('group_id');
        $listMenu = Mage::getModel('menu/items')
            ->getCollection()
            ->addFieldToFilter('group_id', $groupId)
            ->getData();

        foreach ($listMenu as $value) {
            if ($itemId != null && $value['parent_id'] == $itemId) {
                $flag = true;
            }
        }
        return $flag;
    }

    public function getChildrenMenu($item)
    {
        $listMenu = array();
        $data = Mage::getModel('menu/items')
            ->getCollection()
            ->getData();
        foreach ($data as $child) {
            if ($child['parent_id'] == $item) {
                $listMenu[] = $child['menu_id'];
            }
        }
        return $listMenu;
    }
}