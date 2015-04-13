<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_ProductLabel_Model_Source_Label extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
    public function getAllOptions()
    {
        $label = $this->_getTypeLabel();
        $options = array();
        foreach ($label as $key => $value) {
            $options[] = array(
                'value' => $key,
                'label' => $value
            );
        }
        return $options;
    }

    public function toOptionArray()
    {
        return $this->getAllOptions();
    }

    protected function _getTypeLabel()
    {
        $options = array(
            "sale_label" => Mage::helper('product_label')->__('Sale'),
            "best_seller_label" => Mage::helper('product_label')->__('Best Seller'),
            "featured_label" => Mage::helper('product_label')->__('Featured'),
            "new_label" => Mage::helper('product_label')->__('New'),

        );
        return $options;

    }
}