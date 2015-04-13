<?php
/*
* create by user: quynh.
* unit department: fresher 06.
*/
require_once('app/code/core/Mage/Catalog/controllers/CategoryController.php');
class SM_Filter_IndexController extends Mage_Catalog_CategoryController
{
    public function viewAction()
    {
        echo __METHOD__;
        $currentUrl = Mage::helper('core/url')->getCurrentUrl();
        echo $currentUrl;
        return parent::viewAction();
    }
}