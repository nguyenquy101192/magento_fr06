<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Model_Status extends Varien_Object
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLE => Mage::helper('slider')->__('Enable'),
            self::STATUS_DISABLE => Mage::helper('slider')->__('Disable'),
        );
    }
}
 