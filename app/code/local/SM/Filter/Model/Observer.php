<?php
/*
* create by user: quynh.
* unit department: fresher 06.
*/
class SM_Filter_Model_Observer
{

    public function filter_category_by_manufacturer($observer)
    {
        $data = $observer->getCollection()->getData();
//        echo "<pre>";
//        print_r($data);
        if(Mage::registry('manufacturer')) {
            foreach($data as $items) {
            }
        }

    }
}