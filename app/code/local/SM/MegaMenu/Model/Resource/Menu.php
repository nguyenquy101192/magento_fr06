<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Model_Resource_Menu extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('menu/menu', 'group_id');
    }
}
 