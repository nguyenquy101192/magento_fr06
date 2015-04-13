<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_BestSeller_Block_BestSellers extends Mage_Catalog_Block_Product_Abstract
{
    protected $_productCollection = array();

    /*
     *
     *  get products best selling by category
     *
     * */
    public function getBestSellerProducts($categoryId)
    {
        $storeId = Mage::app()->getStore()->getId();
        $category = Mage::getModel('catalog/category')->load($categoryId);
        $fromDate = Mage::getModel('core/date')->date('Y-m-d', strtotime(Mage::getStoreConfig('best_seller/set_date/from_date')));;
        $toDate = Mage::getModel('core/date')->date('Y-m-d', strtotime(Mage::getStoreConfig('best_seller/set_date/to_date')));

        $collection = Mage::getResourceModel('reports/product_collection')
            ->addOrderedQty()
            ->addAttributeToSelect('*')
            ->addCategoryFilter($category)
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->setOrder('ordered_qty', 'desc');

        if($categoryId == null) {
            $this->_productCollection = $collection;
        } else {
            $collection->getSelect()
                    ->joinLeft(
                        array(
                            'aggregation' => $collection->getResource()->getTable('sales/bestsellers_aggregated_monthly')),
                        "e.entity_id = aggregation.product_id AND aggregation.store_id={$storeId} AND aggregation.period BETWEEN '{$fromDate}' AND '{$toDate}'",
                        array('SUM(aggregation.qty_ordered) AS sold_quantity')
                    )
                    ->group('e.entity_id')
                    ->order(array('sold_quantity DESC', 'e.created_at'));
            Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
            Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);

            $collection->setPageSize(3)->setCurPage(1);
            $this->setProductCollection($collection);
            $this->_productCollection = $this->getProductCollection();
        }

        return $this->_productCollection;
    }
}