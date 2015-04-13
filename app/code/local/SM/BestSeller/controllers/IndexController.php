<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_BestSeller_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}