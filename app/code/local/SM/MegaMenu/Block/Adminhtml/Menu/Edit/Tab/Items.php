<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_Items extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('itemsGrid');
        $this->setDefaultSort('menu_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    // add button new item
    public function getMainButtonsHtml()
    {
        $groupId = Mage::app()->getRequest()->getParam('id');
        $html = parent::getMainButtonsHtml(); //get the parent class buttons
        $addButton = $this->getLayout()->createBlock('adminhtml/widget_button') //create the add button
            ->setData(array(
                'label' => Mage::helper('adminhtml')->__('Add New Subcategory'),
                'onclick' => "setLocation('" . $this->getUrl('*/*/newitem/group_id/' . $groupId) . "')",
                'class' => 'add'
            ))->toHtml();
        return $addButton . $html;
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('menu/items')
            ->getCollection()
            ->addFieldToFilter('group_id', $this->getRequest()->getParam('id'));
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('menu_id', array(
            'header' => Mage::helper('mega_menu')->__('ID'),
            'align' => 'center',
            'width' => '50px',
            'index' => 'menu_id',
        ));

        $this->addColumn('menu_name', array(
            'header' => Mage::helper('mega_menu')->__('Name'),
            'align' => 'center',
            'index' => 'menu_name',
        ));

        $this->addColumn('menu_url', array(
            'header' => Mage::helper('mega_menu')->__('URL'),
            'align' => 'center',
            'index' => 'menu_url',
            'renderer' => 'SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Renderer_Items_Url',
        ));

        $this->addColumn('parent_id', array(
            'header' => Mage::helper('mega_menu')->__('Parent'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'parent_id',
            'renderer' => 'SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Renderer_Items_Parent',
        ));

        $this->addColumn('menu_type', array(
            'header' => Mage::helper('mega_menu')->__('Type'),
            'align' => 'left',
            'width' => '150px',
            'index' => 'menu_type',
            'renderer' => 'SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Renderer_Items_Type',
        ));

        $this->addColumn('menu_type_item', array(
            'header' => Mage::helper('mega_menu')->__('List Items'),
            'align' => 'left',
            'width' => '150px',
            'index' => 'menu_type_item',
            'renderer' => 'SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Renderer_Items_ListItems',
        ));

        $this->addColumn('menu_status', array(
            'header' => Mage::helper('mega_menu')->__('Is Active'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'menu_status',
            'type' => 'options',
            'options' => array(
                1 => 'Enable',
                0 => 'Disable',
            ),
        ));

//        $this->addColumn('action_edit', array(
//            'header'   => $this->helper('mega_menu')->__('Action'),
//            'width'    => 50,
//            'align' => 'center',
//            'type'     => 'action',
//            'getter' => 'getId',
//            'actions'  => array(
//                array(
//                    'caption' => Mage::helper('mega_menu')->__('Edit'),
//                    'url'     => array(
//                        'base'=>'*/*/edititem',
//                        'params'=>array('group_id'=>$this->getRequest()->getParam('id'))
//                    ),
//                    'field'   => 'id',
//                )
//            )
//        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edititem', array('id' => $row->getId(), 'group_id' => $row->getGroupId()));
    }
}