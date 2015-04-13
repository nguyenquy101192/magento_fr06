<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Items_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected $_scopeLabel = '';

    protected function _prepareForm()
    {
        $this->_scopeLabel = (Mage::helper('mega_menu')->__('[STORE_VIEW]'));
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('item_form', array('legend' => Mage::helper('mega_menu')->__('Items information')));

        $fieldset->addField('menu_name', 'text', array(
            'label' => Mage::helper('mega_menu')->__('Subcategory name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'menu_name',
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('group_id', 'select', array(
            'label' => 'In group',
            'name' => 'group_id',
            'readonly' => false,
            'options' => Mage::getModel('menu/source_group')->getGroupName(),
        ));

        $fieldset->addField('menu_url', 'text', array(
            'label' => Mage::helper('mega_menu')->__('URL'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'menu_url',
        ));

        $fieldset->addField('parent_id', 'select', array(
            'label' => Mage::helper('mega_menu')->__('Parent'),
            'name' => 'parent_id',
            'options' => Mage::getModel('menu/source_group')->getListMenu(),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        if (Mage::getModel('menu/source_group')->isHasChild()) {
            $fieldset->addField('menu_type', 'select', array(
                'label' => Mage::helper('mega_menu')->__('Type'),
                'name' => 'menu_type',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('mega_menu')->__('Custom Link'),
                    ),
                ),
                'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
            ));
        } else {
            $fieldset->addField('menu_type', 'select', array(
                'label' => Mage::helper('mega_menu')->__('Type'),
                'name' => 'menu_type',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('mega_menu')->__('Custom Link'),
                    ),
                    array(
                        'value' => 2,
                        'label' => Mage::helper('mega_menu')->__('Category Link By Flat'),
                    ),
                    array(
                        'value' => 3,
                        'label' => Mage::helper('mega_menu')->__('Block Link'),
                    ),
                    array(
                        'value' => 4,
                        'label' => Mage::helper('mega_menu')->__('Category Link By Tree'),
                    ),
                ),
                'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
            ));
        }

        $this->setChild('form_after', $this->getLayout()
                ->createBlock('adminhtml/widget_form_element_dependence')
                ->addFieldMap('menu_type', 'menu_type')
                ->addFieldMap('menu_url', 'menu_url')
                ->addFieldMap('menu_type_item', 'menu_type_item')
                ->addFieldMap('show_by_tree', 'show_by_tree')
                ->addFieldMap('cms_block', 'cms_block')
                ->addFieldDependence('menu_url', 'menu_type', 1)
                ->addFieldDependence('menu_type_item', 'menu_type', 2)
                ->addFieldDependence('cms_block', 'menu_type', 3)
                ->addFieldDependence('show_by_tree', 'menu_type', 4)
        );

        $fieldset->addField('menu_type_item', 'multiselect', array(
            'label' => Mage::helper('mega_menu')->__('List Categories & Subcategories'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'list_item[]',
            'values' => Mage::getModel('menu/source_category_list')->getAllOptions(),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('show_by_tree', 'multiselect', array(
            'label' => Mage::helper('mega_menu')->__('Show by tree'),
            'name' => 'show_by_tree',
            'values' => Mage::getModel('menu/source_category_tree')->getAllOptions(),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('cms_block', 'select', array(
            'label' => Mage::helper('mega_menu')->__('Block'),
            'name' => 'list_item[]',
            'values' => Mage::getModel('menu/source_blockList')->getAllBlock(),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('menu_status', 'select', array(
            'label' => Mage::helper('mega_menu')->__('Is active'),
            'name' => 'menu_status',
            'options' => array(
                '0' => Mage::helper('mega_menu')->__('Disabled'),
                '1' => Mage::helper('mega_menu')->__('Enabled'),

            ),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        if (Mage::registry('item_data')) {
            $form->setValues(Mage::registry('item_data')->getData());
        }
        return parent::_prepareForm();

        $this->_redirect('*/*/*', $this->getRequest()->getParams());
    }
}
 