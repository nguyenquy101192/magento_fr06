<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Edit_Tab_Renderer_Slider_StoreView
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $listStoreViews = array();
        $store_id = explode(',', $row->getData($this->getColumn()->getIndex()));
        $allStoreViews = Mage::getModel('core/store')->getCollection()->getData('store_id');
        $stores = Mage::getModel('core/store')->getCollection()->addFieldToFilter('store_id', $store_id);
        array_shift($allStoreViews);
        if (count($allStoreViews) == count($store_id) || $store_id[0] == 0) {
            return 'All Store Views';
        } else {
            foreach ($stores->getData() as $value) {
                $listStoreViews[] = $value['name'];
            }
            $listStoreViews = implode(', ', $listStoreViews);
            return $listStoreViews;
        }
    }
}