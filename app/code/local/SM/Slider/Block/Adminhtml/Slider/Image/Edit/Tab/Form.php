<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Adminhtml_Slider_Image_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected $_scopeLabel = '';

    protected function _prepareForm()
    {
        $this->_scopeLabel = (Mage::helper('slider')->__('[STORE_VIEW]'));
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slider_form', array('legend' => Mage::helper('slider')->__('Items information')));

        $fieldset->addField('image_name', 'text', array(
            'label' => Mage::helper('slider')->__('Image name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'image_name',
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('slider_id', 'select', array(
            'label' => 'In album',
            'name' => 'slider_id',
            'readonly' => false,
            'options' => Mage::getModel('slider/source_album')->getAlbumName(),
        ));

        $fieldset->addField('image_caption', 'textarea', array(
            'label' => Mage::helper('slider')->__('Caption'),
            'name' => 'image_caption',
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        $fieldset->addField('image_link', 'image', array(
            'label' => Mage::helper('slider')->__('Link'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'image_link',
        ));

        $fieldset->addField('image_status', 'select', array(
            'label' => Mage::helper('slider')->__('Is active'),
            'name' => 'image_status',
            'options' => array(
                '0' => Mage::helper('slider')->__('Disabled'),
                '1' => Mage::helper('slider')->__('Enabled'),

            ),
            'after_element_html' => "<td class='scope-label'><span class='nobr'>" . $this->_scopeLabel . "</span></td>",
        ));

        if (Mage::registry('image_data')) {
            $form->setValues(Mage::registry('image_data')->getData());
        }
        return parent::_prepareForm();

        $this->_redirect('*/*/*', $this->getRequest()->getParams());
    }
}
 