<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Resource_Items_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('menu/items');
    }
}
 