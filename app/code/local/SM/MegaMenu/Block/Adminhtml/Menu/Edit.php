<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'sm_mega_menu';
        $this->_controller = 'adminhtml_menu'; // call to container class edit

        $this->_updateButton('save', 'label', Mage::helper('mega_menu')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('mega_menu')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('menu_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'menu_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'menu_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('menu_data') && Mage::registry('menu_data')->getId()) {
            return Mage::helper('mega_menu')->__("Edit Category '" . strtoupper($this->escapeHtml(Mage::registry('menu_data')->getGroupName())) . "'");
        } else {
            return Mage::helper('mega_menu')->__('Add New Category');
        }
    }
}
 