<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo __METHOD__;
        $this->loadLayout();
        $this->renderLayout();
    }
}
 