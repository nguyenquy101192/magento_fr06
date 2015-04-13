<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_ProductLabel_Model_Source_Image_Sale extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
    public function toOptionArray()
    {
        $images = Mage::getSingleton('label/label')
            ->getCollection()
            ->addFieldToSelect('*')
            ->addFieldToFilter('label_type', 2)
            ->getData();
        $options = array();
        $options[0] = array(
            'value' => 0,
            'label' => 'Please select image'
        );
        foreach ($images as $key => $value) {
            $options[] = array(
                'value' => $value['label_link'],
                'label' => $value['label_name']
            );
        }
        return $options;
    }
}