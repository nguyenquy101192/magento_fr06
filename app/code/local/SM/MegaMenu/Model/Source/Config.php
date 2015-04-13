<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Source_Config extends Mage_Core_Model_Abstract
{
    public function toOptionArray()
    {
        $options = array();
        $options[0] = array(
            'value' => '1',
            'label' => 'Enable',
        );

        $options[1] = array(
            'value' => '0',
            'label' => 'Disable',
        );

        return $options;
    }

}