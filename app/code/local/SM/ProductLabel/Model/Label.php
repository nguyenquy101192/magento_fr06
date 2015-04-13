<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_ProductLabel_Model_Label extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('label/label');
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();

        $this->setData('label_link', "logo/" . $_FILES['label_link']['name']);
        return $this;
    }
}