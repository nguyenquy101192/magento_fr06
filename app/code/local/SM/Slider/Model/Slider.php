<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Model_Slider extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('slider/slider');
    }

    public function _beforeSave()
    {
        parent::_beforeSave();
        $data = $this->getData('storeView');
        $listViews = Mage::getModel('core/store')->getCollection()->getData('store_id');
        array_shift($listViews);
        if (count($data) == count($listViews)) {
            $this->setData('store_view', 0);
        } else {
            $data = implode(',', $data);
            $this->setData('store_view', $data);
        }
        return $this;
    }

    public function getAllStoreViews()
    {
        $arr = Mage:: getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true);
        return $arr;
    }
}
 