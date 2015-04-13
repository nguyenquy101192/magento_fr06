<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Source_BlockList
{
    protected $_options;

    public function getAllBlock()
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('cms/block_collection')
                ->load()
                ->toOptionArray();
        }

        return $this->_options;
    }
}
 