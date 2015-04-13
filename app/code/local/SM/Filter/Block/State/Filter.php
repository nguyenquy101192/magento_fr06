<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_Filter_Block_State_Filter extends Mage_Core_Block_Template
{
    protected $_stateFilter = array();

    protected $_url = '';


    //get state filter currently
    public function getStateFilter()
    {
        if ($this->isHasState()) {
            $categoryId = Mage::app()->getRequest()->getParam('id');
            $listBrands = Mage::app()->getRequest()->getPost('brand');
            $listSizes = Mage::app()->getRequest()->getPost('size');
            $listColors = Mage::app()->getRequest()->getPost('color');
            $lowPrices = Mage::app()->getRequest()->getPost('low_price');
            $heightPrices = Mage::app()->getRequest()->getPost('height_price');

            $attributeOptionSingle = Mage::getResourceModel('eav/entity_attribute_option_collection')
                ->setStoreFilter()
                ->load()
                ->getData();
            foreach ($attributeOptionSingle as $items) {
                if ($listBrands && $listBrands != null) {
                    foreach ($listBrands as $brandIds) {
                        if ($items['option_id'] == $brandIds) {
                            $this->_stateFilter['brand'][] = $items['default_value'];
                        }
                    }
                }
                if ($listSizes && $listSizes != null) {
                    if ($items['option_id'] == $listSizes) {
                        $this->_stateFilter['size'] = $items['default_value'];
                    }
                }
                if ($listColors && $listColors != null) {
                    foreach ($listColors as $colorIds) {
                        if ($items['option_id'] == $colorIds) {
                            $this->_stateFilter['color'][] = $items['default_value'];
                        }
                    }
                }
                if ($lowPrices && $lowPrices != null) {
                    if ($heightPrices && $heightPrices != null) {
                        $this->_stateFilter['low_price'] = $lowPrices;
                        $this->_stateFilter['height_price'] = $heightPrices;
                    } else {
                        $this->_stateFilter['low_price'] = $lowPrices;
                    }
                }
                if ($heightPrices && $heightPrices != null) {
                    if ($lowPrices && $lowPrices != null) {
                        $this->_stateFilter['low_price'] = $lowPrices;
                        $this->_stateFilter['height_price'] = $heightPrices;
                    } else {
                        $this->_stateFilter['height_price'] = $heightPrices;
                    }
                }
            }
        }
        return $this->_stateFilter;
    }


    /*
     *  check state current
     */
    public function isHasState()
    {
        $flag = false;
        if (Mage::app()->getRequest()->getParam('click')) {
            $flag = true;
        }
        return $flag;
    }


    /*
     *  get rewrite url category by id
     * */
    public function getUrlCategory($item)
    {
        $data = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', '1')
            ->addAttributeToFilter('include_in_menu', '1')
            ->addAttributeToFilter('entity_id', $item)
            ->addUrlRewriteToResult();
        foreach ($data as $urls) {
            $this->_url = $urls->getUrlPath();
        }
        return $this->getUrl($this->_url);
    }
}