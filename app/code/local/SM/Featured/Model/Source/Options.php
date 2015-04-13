<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Featured_Model_Source_Options extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
                array(
                    'value' => '0',
                    'label' => 'No',
                ),
                array(
                    'value' => '1',
                    'label' => 'Yes',
                )
            );
        }
        return $this->_options;
    }
}
 