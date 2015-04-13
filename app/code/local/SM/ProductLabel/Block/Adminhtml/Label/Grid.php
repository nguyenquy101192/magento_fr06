<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_ProductLabel_Block_Adminhtml_Label_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('productLabelGrid');
        $this->setDefaultSort('label_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('label/label')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('label_id', array(
            'header' => Mage::helper('product_label')->__('ID'),
            'align' => 'center',
            'width' => '50px',
            'index' => 'label_id',
        ));

        $this->addColumn('label_link', array(
            'header' => Mage::helper('product_label')->__('Logo'),
            'align' => 'center',
            'width' => '200px',
            'index' => 'label_link',
            'renderer' => 'SM_ProductLabel_Block_Adminhtml_Label_Edit_Tab_Renderer_Label_Logo',
        ));

        $this->addColumn('label_name', array(
            'header' => Mage::helper('product_label')->__('Name'),
            'align' => 'center',
            'index' => 'label_name',
        ));

        $this->addColumn('label_type', array(
            'header' => Mage::helper('product_label')->__('Type'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'label_type',
            'renderer' => 'SM_ProductLabel_Block_Adminhtml_Label_Edit_Tab_Renderer_Label_Type',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('product_label')->__('Status'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'status',
            'renderer' => 'SM_ProductLabel_Block_Adminhtml_Label_Edit_Tab_Renderer_Label_Status',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassAction()
    {
        $this->setMassactionIdField('label_id');
        $this->getMassactionBlock()->setFormFieldName('product_label');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('product_label')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('product_label')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('label/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('product_label')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('product_label')->__('Status'),
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
 