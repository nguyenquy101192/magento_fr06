<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('sliderGrid');
        $this->setDefaultSort('slider_status');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slider/slider')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('slider_id', array(
            'header' => Mage::helper('slider')->__('ID'),
            'align' => 'center',
            'width' => '50px',
            'index' => 'slider_id',
        ));

        $this->addColumn('slider_name', array(
            'header' => Mage::helper('slider')->__('Name'),
            'align' => 'center',
            'index' => 'slider_name',
        ));

        $this->addColumn('slider_desc', array(
            'header' => Mage::helper('slider')->__('Description'),
            'align' => 'center',
            'index' => 'slider_desc',
        ));

        $this->addColumn('store_view', array(
            'header' => Mage::helper('slider')->__('Store View'),
            'align' => 'center',
            'index' => 'store_view',
            'renderer' => 'SM_Slider_Block_Adminhtml_Slider_Edit_Tab_Renderer_Slider_StoreView',
        ));

        $this->addColumn('slider_status', array(
            'header' => Mage::helper('slider')->__('Status'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'slider_status',
            'renderer' => 'SM_Slider_Block_Adminhtml_Slider_Edit_Tab_Renderer_Slider_Status',
        ));

//        $this->addColumn('action_edit', array(
//            'header'   => $this->helper('slider')->__('Action'),
//            'width'    => 50,
//            'align' => 'center',
//            'type'     => 'action',
//            'getter' => 'getId',
//            'actions'  => array(
//                array(
//                    'caption' => Mage::helper('slider')->__('Edit'),
//                    'url'     => array('base'=>'*/*/edit'),
//                    'field'   => 'id'
//                )
//            )
//        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassAction()
    {
        $this->setMassactionIdField('slider_id');
        $this->getMassactionBlock()->setFormFieldName('slider');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('slider')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('slider')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('slider/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('slider')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('slider')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}