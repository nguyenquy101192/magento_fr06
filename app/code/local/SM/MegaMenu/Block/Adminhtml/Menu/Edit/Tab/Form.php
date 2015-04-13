<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected $_scopeLabel = '';

    protected function _prepareForm()
    {
        $this->_scopeLabel = (Mage::helper('mega_menu')->__('[STORE_VIEW]'));
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('menu_form', array('legend' => Mage::helper('mega_menu')->__('General information')));

        $fieldset->addField('group_name', 'text', array(
            'label' => Mage::helper('mega_menu')->__('Category name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'group_name',
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('group_type', 'select', array(
            'label' => Mage::helper('mega_menu')->__('Type'),
            'name' => 'group_type',
            'options' => array(
                '0' => Mage::helper('mega_menu')->__('Horizontal'),
                '1' => Mage::helper('mega_menu')->__('Vertical'),
            ),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $this->setChild('form_after', $this->getLayout()
                ->createBlock('adminhtml/widget_form_element_dependence')
                ->addFieldMap('group_type', 'group_type')
                ->addFieldMap('position_horizontal', 'position_horizontal')
                ->addFieldMap('position_vertical', 'position_vertical')
                ->addFieldDependence('position_horizontal', 'group_type', 0)
                ->addFieldDependence('position_vertical', 'group_type', 1)
        );

        $fieldset->addField('position_horizontal', 'select', array(
            'label' => Mage::helper('mega_menu')->__('Position'),
            'name' => 'position',
            'options' => array(
                '0' => Mage::helper('mega_menu')->__('None'),
                '1' => Mage::helper('mega_menu')->__('Top'),
                '4' => Mage::helper('mega_menu')->__('Foot'),
            ),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('position_vertical', 'select', array(
            'label' => Mage::helper('mega_menu')->__('Position'),
            'name' => 'position',
            'options' => array(
                '0' => Mage::helper('mega_menu')->__('None'),
                '2' => Mage::helper('mega_menu')->__('Left'),
                '3' => Mage::helper('mega_menu')->__('Right'),
            ),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('store_view', 'multiselect', array(
            'label' => Mage::helper('mega_menu')->__('Store view'),
            'class' => 'required-entry',
            'width' => '100px',
            'required' => true,
            'name' => 'storeView[]',
            'values' => Mage::getModel('menu/menu')->getAllStoreViews(),
        ));

        $fieldset->addField('group_status', 'select', array(
            'label' => Mage::helper('mega_menu')->__('Is active'),
            'name' => 'group_status',
            'options' => array(
                '0' => Mage::helper('mega_menu')->__('Disabled'),
                '1' => Mage::helper('mega_menu')->__('Enabled'),
            ),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        if (Mage::registry('menu_data')) {
            $form->setValues(Mage::registry('menu_data')->getData());
        }
        return parent::_prepareForm();
    }
}
 