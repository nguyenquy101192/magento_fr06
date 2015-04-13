<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Image_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'sm_slider';
        $this->_controller = 'adminhtml_slider_image'; // call to container class edit

        $this->_updateButton('save', 'label', Mage::helper('slider')->__('Save Item'));

        $id = $this->getRequest()->getParam('id');
        $slider_id = $this->getRequest()->getParam('slider_id');
        $this->_addButton('delete', array(
            'label' => Mage::helper('slider')->__('Delete Image'),
            'onclick' => "deleteConfirm('Are you sure you want to do this?', '" . $this->getUrl("*/*/deleteimage/id/" . $id . "/slider_id/" . $slider_id) . "')",
            'class' => 'delete',
        ));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('image_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'image_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'image_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/editimage/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('image_data') && Mage::registry('image_data')->getId()) {
            return Mage::helper('slider')->__("Edit - " . strtoupper($this->escapeHtml(Mage::registry('image_data')->getImageName())));
        } else {
            return Mage::helper('slider')->__('Add New Item');
        }
    }
}
 