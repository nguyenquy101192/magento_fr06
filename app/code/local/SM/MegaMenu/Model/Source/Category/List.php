<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Source_Category_List
{
    protected $_string = '';

    public function getAllOptions()
    {
        $listCategories = Mage::getModel('catalog/category')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', '1')
            ->addAttributeToFilter('include_in_menu', '1')
            ->addAttributeToSort('position', 'asc')
            ->load();
        $data = array();
        foreach ($listCategories as $item) {
            $data[] = array(
                'id' => $item->getId(),
                'name' => $item->getName(),
                'children' => $item->getChildren(),
                'parent' => $item->getParentId(),
                'position' => $item->getPosition(),
                'level' => $item->getLevel(),
            );

        }
        $data = $this->_sortArray($data);
        $array = array();
        foreach ($data as $dataInfo) {
            $array[] = array(
                'value' => $dataInfo['id'],
                'label' => $this->_getMargin($dataInfo['level']) . " " . $dataInfo['name'],
            );
        }

        return $array;
    }

    /*
     * Sort array to tree category
     */
    protected function _sortArray($data = array())
    {
        foreach ($data as $key => $value) {
            if ($value['parent'] == 1) {
                $this->_string .= $value['id'] . ", ";
                if ($value['children'] != null) {
                    $this->_getChildItem($value['id'], $data);
                }
            }
        }
        $listItems = explode(",", $this->_string);
        $array = array();
        foreach ($listItems as $item) {
            foreach ($data as $dataInfo) {
                if ($dataInfo['id'] == $item) {
                    $array[] = $dataInfo;
                }
            }
        }
        return $array;
    }


    /*
     * Get children of item in array
     */
    protected function _getChildItem($parentId, $array = array())
    {
        foreach ($array as $value) {
            if ($value['parent'] == $parentId) {
                $this->_string .= $value['id'] . ", ";
                if ($value['children'] != null)
                    $this->_getChildItem($value['id'], $array);
            }
        }
        return $this->_string;
    }


    /*
     * insert margin to option array
     */
    protected function _getMargin($margin)
    {
        $string = '';
        for ($i = 0; $i < $margin; $i++) {
            $string .= "-----";
        }
        return $string;
    }
}