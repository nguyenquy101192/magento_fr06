<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected $_scopeLabel = '';

    protected function _prepareForm()
    {
        $this->_scopeLabel = (Mage::helper('slider')->__('[STORE_VIEW]'));
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slider_form', array('legend' => Mage::helper('slider')->__('General information')));

        $fieldset->addField('slider_name', 'text', array(
            'label' => Mage::helper('slider')->__('Album name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'slider_name',
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('slider_desc', 'textarea', array(
            'label' => Mage::helper('slider')->__('Description'),
            'name' => 'slider_desc',
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('store_view', 'multiselect', array(
            'label' => Mage::helper('slider')->__('Store view'),
            'class' => 'required-entry',
            'width' => '100px',
            'required' => true,
            'name' => 'storeView[]',
            'values' => Mage::getModel('slider/slider')->getAllStoreViews(),
        ));

        $fieldset->addField('slider_status', 'select', array(
            'label' => Mage::helper('slider')->__('Is active'),
            'name' => 'slider_status',
            'options' => array(
                '0' => Mage::helper('slider')->__('Disabled'),
                '1' => Mage::helper('slider')->__('Enabled'),
            ),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        if (Mage::registry('slider_data')) {
            $form->setValues(Mage::registry('slider_data')->getData());
        }
        return parent::_prepareForm();
    }
}
 