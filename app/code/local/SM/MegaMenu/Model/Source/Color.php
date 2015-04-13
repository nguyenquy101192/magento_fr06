<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Source_Color extends Mage_Core_Model_Abstract
{
    public function toOptionArray()
    {
        $options = array(
            array(
                'value' => '#2888D2',
                'label' => 'Default',
            ),
            array(
                'value' => 'red',
                'label' => 'Red',
            ),
            array(
                'value' => 'blue',
                'label' => 'Blue',
            ),
            array(
                'value' => 'black',
                'label' => 'Black',
            ),
            array(
                'value' => 'purple',
                'label' => 'Purple',
            ),
            array(
                'value' => 'darkgreen',
                'label' => 'Dark green',
            ),
        );
        return $options;
    }

}