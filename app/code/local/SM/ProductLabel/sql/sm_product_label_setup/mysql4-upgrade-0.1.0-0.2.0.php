<?php
/*
* create by user: quynh.
* unit department: fresher 06.
*/
$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$setup->addAttribute('catalog_product', 'product_label', array(
    'label' => 'Label For Product',
    'group' => 'Product Label',
    'input' => 'multiselect',
    'type' => 'varchar',
    'attribute_set' => 'Default',
    'frontend' => '',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'source' => 'label/source_label',
    'backend' => 'eav/entity_attribute_backend_array',
    'visible' => true,
    'required' => false,
    'user_defined' => true,
    'searchable' => false,
    'filterable' => false,
    'comparable' => false,
    'visible_on_front' => false,
    'unique' => false,
    'order' => 1,
    'visible_in_advanced_search' => false,
));

$installer->endSetup();
