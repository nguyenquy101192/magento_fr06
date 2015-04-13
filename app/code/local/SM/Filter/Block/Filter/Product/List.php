<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_Filter_Block_Filter_Product_List extends Mage_Catalog_Block_Product_List
{

    /*
     *
     *  filter by ajax if exist ajax post value.
     *
     * */
    protected function _getProductCollection()
    {
        if (Mage::app()->getRequest()->getPost('click')) {
            $categoryId = Mage::app()->getRequest()->getParam('id');
            $listBrands = Mage::app()->getRequest()->getPost('brand');
            $listSizes = Mage::app()->getRequest()->getPost('size');
            $listColors = Mage::app()->getRequest()->getPost('color');
            $lowPrice = Mage::app()->getRequest()->getPost('low_price');
            $heightPrice = Mage::app()->getRequest()->getPost('height_price');
            $collection = Mage::getSingleton('catalog/category')
                ->load($categoryId)
                ->getProductCollection()
                ->addAttributeToSelect('*');

            if ($listBrands && count($listBrands) != 0) {
                $listProductsByFilter = $collection->addAttributeToFilter('brand', array('in' => $listBrands));
            }
            if ($listSizes && count($listSizes) != 0) {
                $listProductsByFilter = $collection->addAttributeToFilter('size', array('in' => $listSizes));
            }
            if ($listColors && count($listColors) != 0) {
                $listProductsByFilter = $collection->addAttributeToFilter('color', array('in' => $listColors));
            }
            if ($lowPrice && count($lowPrice) != 0) {
                $listProductsByFilter = $collection->addAttributeToFilter('price', array('gteq' => $lowPrice));
            }
            if ($heightPrice && count($heightPrice) != 0) {
                $listProductsByFilter = $collection->addAttributeToFilter('price', array('lteq' => $heightPrice));
            } else {
                $listProductsByFilter = $collection;
            }
            $this->_productCollection = $listProductsByFilter;
        }
        return parent::_getProductCollection();
    }
}