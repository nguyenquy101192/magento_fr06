<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Model_Source_Album
{
    public function getAlbumName()
    {
        $sliderId = Mage::app()->getRequest()->getParam('slider_id');
        $listSlider = Mage::getModel('slider/slider')
            ->getCollection()
            ->addFieldToSelect('slider_id')
            ->addFieldToSelect('slider_name')
            ->addFieldToFilter('slider_id', $sliderId)
            ->getData();

        $sliderName = array();
        $sliderName[$sliderId] = $listSlider[0]['slider_name'];
        return $sliderName;
    }
}
 