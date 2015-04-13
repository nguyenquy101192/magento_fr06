<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Model_Resource_Image extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('slider/image', 'image_id');
    }
}
 