<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Model_Image extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('slider/image');
    }

    public function _beforeSave()
    {
        parent::_beforeSave();

        $this->setData('image_link', "slide/" . $_FILES['image_link']['name']);
        return $this;
    }
}
 