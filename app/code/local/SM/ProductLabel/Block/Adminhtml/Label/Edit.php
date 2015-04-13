<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_ProductLabel_Block_Adminhtml_Label_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'sm_product_label';
        $this->_controller = 'adminhtml_label'; // call to container class edit

        $this->_updateButton('save', 'label', Mage::helper('product_label')->__('Save Label'));
        $this->_updateButton('delete', 'label', Mage::helper('product_label')->__('Delete Label'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('product_label_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'product_label_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'product_label_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('product_label_data') && Mage::registry('product_label_data')->getId()) {
            return Mage::helper('product_label')->__("Edit label '" . strtoupper($this->escapeHtml(Mage::registry('product_label_data')->getLabelName())) . "'");
        } else {
            return Mage::helper('product_label')->__('Add label');
        }
    }
}
 