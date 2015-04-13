<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Source_Menu extends Mage_Core_Model_Abstract
{
    public function toOptionArray()
    {
        $collection = Mage::getSingleton('menu/menu')->getCollection()->getData();
        $options = array();
        foreach ($collection as $key => $value) {
            $options[] = array(
                'value' => $value['group_id'],
                'label' => $value['group_name'],
            );
        }
        return $options;
    }

}