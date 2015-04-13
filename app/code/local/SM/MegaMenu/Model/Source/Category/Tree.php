<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_MegaMenu_Model_Source_Category_Tree
{
    public function getAllOptions()
    {
        $options = array();
        $listCategories = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('level', 2);
        foreach ($listCategories as $item) {
            $options[] = array(
                'value' => $item->getId(),
                'label' => $item->getName()
            );
        }
        return $options;
    }
}