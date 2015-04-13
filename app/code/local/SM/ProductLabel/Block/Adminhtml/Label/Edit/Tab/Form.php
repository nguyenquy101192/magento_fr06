<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_ProductLabel_Block_Adminhtml_Label_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected $_scopeLabel = '';

    protected function _prepareForm()
    {
        $this->_scopeLabel = (Mage::helper('product_label')->__('[STORE_VIEW]'));
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('product_label_form', array('legend' => Mage::helper('product_label')->__('General information')));

        $fieldset->addField('label_name', 'text', array(
            'label' => Mage::helper('product_label')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'label_name',
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('label_link', 'image', array(
            'label' => Mage::helper('product_label')->__('Logo'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'label_link',
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('label_type', 'select', array(
            'label' => Mage::helper('product_label')->__('Type'),
            'name' => 'label_type',
            'options' => array(
                '1' => Mage::helper('product_label')->__('New'),
                '2' => Mage::helper('product_label')->__('Sale'),
                '3' => Mage::helper('product_label')->__('Best Seller'),
                '4' => Mage::helper('product_label')->__('Feature'),
            ),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('product_label')->__('Is Active'),
            'name' => 'status',
            'options' => array(
                '0' => Mage::helper('product_label')->__('Disable'),
                '1' => Mage::helper('product_label')->__('Enable'),
            ),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        if (Mage::registry('product_label_data')) {
            $form->setValues(Mage::registry('product_label_data')->getData());
        }
        return parent::_prepareForm();
    }
}
 