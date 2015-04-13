<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_Filter_Block_Filter_Layer_Filter extends Mage_Core_Block_Template
{

    /*
     *
     *  get attribute to filter by attribute_code
     *
     * */
    public function getAttributeToFilter($attribute_code)
    {
        $categoryId = Mage::app()->getRequest()->getParam('id');
        $collection = Mage::getSingleton('catalog/category')
            ->load($categoryId)
            ->getProductCollection()
            ->addAttributeToSelect($attribute_code);

        return $collection;
    }


    /*
     *
     *  remove items is duplicated in list attribute to filter
     *
     * */
    public function removeItemDuplicateValue($listItems, $attribute)
    {
        $data = array();
        foreach($listItems as $values) {
            if($attribute == 'size') {
                $data[$values->getSize()] = $values->getAttributeText($attribute);
            } elseif($attribute == 'brand') {
                $data[$values->getBrand()] = $values->getAttributeText($attribute);
            } elseif($attribute == 'color') {
                $data[$values->getColor()] = $values->getAttributeText($attribute);
            }
        }
        return array_unique($data);
    }

    public function getProductByCategory()
    {
        $categoryId = Mage::app()->getRequest()->getParam('id');
        $collection = Mage::getSingleton('catalog/category')
            ->load($categoryId)
            ->getProductCollection();

        return $collection;
    }


    /*
     *
     *  count product of each attribute in layout filter
     *
     * */
    public function countProductByAttribute($attribute_id, $attribute_value)
    {
        $categoryId = Mage::app()->getRequest()->getParam('id');
        $collection = Mage::getSingleton('catalog/category')
            ->load($categoryId)
            ->getProductCollection()
            ->addAttributeToFilter($attribute_value, $attribute_id);

        return count($collection);
    }
}