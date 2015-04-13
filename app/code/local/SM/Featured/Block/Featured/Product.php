<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Featured_Block_Featured_Product extends Mage_Core_Block_Template
{
    protected $_productCollection = array();


    /*
     *
     *  get product featured by category
     *
     * */
    public function getFeaturedProducts($categoryId)
    {
        $storeId = Mage::app()->getStore()->getId();
        if ($categoryId == null) {
            $collection = Mage::getModel('catalog/product')->getCollection();
            $attributes = Mage::getSingleton('catalog/config')
                ->getProductAttributes();
            $collection->addAttributeToSelect($attributes)
                ->addMinimalPrice()
                ->addFinalPrice()
                ->addTaxPercents()
                ->addAttributeToFilter('is_featured', 1)
                ->addAttributeToFilter('status', 1)
                ->addAttributeToFilter('visibility', 4)
                ->addStoreFilter();

            $this->_productCollection = $collection;
        } else {
            $collection = Mage::getModel('catalog/product')->getCollection();
            $attributes = Mage::getSingleton('catalog/config')
                ->getProductAttributes();
            $collection->addAttributeToSelect($attributes)
                ->addMinimalPrice()
                ->addFinalPrice()
                ->addTaxPercents()
                ->joinField('category_id', 'catalog/category_product', 'category_id', 'product_id = entity_id', null, 'left')
                ->addAttributeToFilter('category_id', $categoryId)
                ->addAttributeToFilter('is_featured', 1)
                ->addAttributeToFilter('status', 1)
                ->addAttributeToFilter('visibility', 4)
                ->addStoreFilter();

            $this->_productCollection = $collection;
        }

        return $this->_productCollection;
    }
}
 