<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Resource_Items extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('menu/items', 'menu_id');
    }
}
 