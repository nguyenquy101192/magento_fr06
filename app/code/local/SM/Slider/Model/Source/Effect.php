<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Model_Source_Effect extends Mage_Core_Model_Abstract
{
    public function toOptionArray()
    {
        $options = array();
        $options[0] = array(
            'value' => 'slide',
            'label' => 'Slide'
        );
        $options[1] = array(
            'value' => 'fade',
            'label' => 'Fade'
        );
        return $options;
    }

}
 