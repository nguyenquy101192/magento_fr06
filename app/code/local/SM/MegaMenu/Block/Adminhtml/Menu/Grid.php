<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('menuGrid');
        $this->setDefaultSort('group_status');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('menu/menu')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('group_id', array(
            'header' => Mage::helper('mega_menu')->__('ID'),
            'align' => 'center',
            'width' => '50px',
            'index' => 'group_id',
        ));

        $this->addColumn('group_name', array(
            'header' => Mage::helper('mega_menu')->__('Name'),
            'align' => 'left',
            'index' => 'group_name',
        ));

        $this->addColumn('store_view', array(
            'header' => Mage::helper('mega_menu')->__('Store view'),
            'align' => 'left',
            'width' => '300px',
            'index' => 'store_view',
            'renderer' => 'SM_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_Renderer_Group_StoreView',
        ));

        $this->addColumn('group_type', array(
            'header' => Mage::helper('mega_menu')->__('Type'),
            'align' => 'left',
            'width' => '100px',
            'index' => 'group_type',
            'renderer' => 'SM_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_Renderer_Group_Type'
        ));

        $this->addColumn('position', array(
            'header' => Mage::helper('mega_menu')->__('Position'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'position',
            'renderer' => 'SM_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_Renderer_Group_Position',
        ));

        $this->addColumn('group_status', array(
            'header' => Mage::helper('mega_menu')->__('Is Active'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'group_status',
            'type' => 'options',
            'options' => array(
                1 => 'Enable',
                0 => 'Disable',
            ),
        ));

//        $this->addColumn('action_edit', array(
//            'header'   => $this->helper('mega_menu')->__('Action'),
//            'width'    => 50,
//            'align'    => 'center',
//            'type'     => 'action',
//            'getter'   => 'getId',
//            'actions'  => array(
//                array(
//                    'caption' => Mage::helper('mega_menu')->__('Edit'),
//                    'url'     => array('base'=>'*/*/edit'),
//                    'field'   => 'id'
//                )
//            )
//        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassAction()
    {
        $this->setMassactionIdField('group_id');
        $this->getMassactionBlock()->setFormFieldName('menu');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('mega_menu')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('mega_menu')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('menu/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('mega_menu')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('mega_menu')->__('Status'),
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
 