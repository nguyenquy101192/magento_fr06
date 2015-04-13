<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'sm_mega_menu';
        $this->_controller = 'adminhtml_menu_items'; // call to container class edit

        $this->_updateButton('save', 'label', Mage::helper('mega_menu')->__('Save Item'));

        $id = $this->getRequest()->getParam('id');
        $group_id = $this->getRequest()->getParam('group_id');
        $this->_addButton('delete', array(
            'label' => Mage::helper('mega_menu')->__('Delete Item'),
            'onclick' => "deleteConfirm('Are you sure you want to do this?', '" . $this->getUrl("*/*/deleteitem/id/" . $id . "/group_id/" . $group_id). "')",
            'class' => 'delete',
        ));

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
        if (Mage::registry('item_data') && Mage::registry('item_data')->getId()) {
            return Mage::helper('mega_menu')->__("Edit Subcategory '" . strtoupper($this->escapeHtml(Mage::registry('item_data')->getMenuName())) . "'");
        } else {
            return Mage::helper('mega_menu')->__('Add New Subcategory');
        }
    }
}
 