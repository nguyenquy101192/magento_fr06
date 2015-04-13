<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Edit_Tab_Image extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('imageGrid');
        $this->setDefaultSort('image_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    // add button new image
    public function getMainButtonsHtml()
    {
        $sliderId = Mage::app()->getRequest()->getParam('id');
        $html = parent::getMainButtonsHtml(); //get the parent class buttons
        $addButton = $this->getLayout()->createBlock('adminhtml/widget_button') //create the add button
            ->setData(array(
                'label' => Mage::helper('adminhtml')->__('Add New Image'),
                'onclick' => "setLocation('" . $this->getUrl('*/*/newimage/slider_id/' . $sliderId) . "')",
                'class' => 'add'
            ))->toHtml();
        return $addButton . $html;
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slider/image')
            ->getCollection()
            ->addFieldToFilter('slider_id', $this->getRequest()->getParam('id'));
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('image_id', array(
            'header' => Mage::helper('slider')->__('ID'),
            'align' => 'center',
            'width' => '50px',
            'index' => 'image_id',
        ));

        $this->addColumn('image_link', array(
            'header' => Mage::helper('slider')->__('Link'),
            'align' => 'center',
            'width' => '150px',
            'height' => '200px',
            'index' => 'image_link',
            'renderer' => 'SM_Slider_Block_Adminhtml_Slider_Image_Edit_Tab_Renderer_Image_Image',
        ));

        $this->addColumn('image_name', array(
            'header' => Mage::helper('slider')->__('Name'),
            'align' => 'center',
            'index' => 'image_name',
        ));

        $this->addColumn('image_caption', array(
            'header' => Mage::helper('slider')->__('Caption'),
            'align' => 'center',
            'index' => 'image_caption',
        ));

        $this->addColumn('image_status', array(
            'header' => Mage::helper('slider')->__('Status'),
            'align' => 'center',
            'width' => '50px',
            'index' => 'image_status',
            'renderer' => 'SM_Slider_Block_Adminhtml_Slider_Image_Edit_Tab_Renderer_Image_Status',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/editimage', array('id' => $row->getId(), 'slider_id' => $row->getSliderId()));
    }
}