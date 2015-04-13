<?php
/*
* create by user: quynh.
* unit department: fresher 06.
*/
require_once 'Mage/Catalog/controllers/CategoryController.php';

class SM_Filter_CategoryController extends Mage_Catalog_CategoryController
{
    public function viewAction()
    {
        parent::viewAction();
        if (Mage::app()->getRequest()->getPost('click')) {
            $listProducts = $this->getLayout()->getBlock('product_list')->toHtml();
            $state = $this->getLayout()->createBlock('sm_filter/state_filter', 'state')->setTemplate('sm/state.phtml')->toHtml();

            // send block to ajax by array
            $response['listproducts'] = $listProducts;
            $response['state'] = $state;
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        }
    }
}