<?php
/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/
$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$setup->addAttributeGroup('catalog_product', 'Default', 'Special Attributes', 1000);

$setup->addAttribute('catalog_product', 'is_featured', array(
    'label' => 'Is Featured',
    'type' => 'int',
    'input' => 'select',
    'backend' => 'eav/entity_attribute_backend_array',
    'frontend' => '',
    'source' => 'featured/source_options',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'user_defined' => true,
    'searchable' => false,
    'filterable' => false,
    'comparable' => false,
    'visible_on_front' => false,
    'visible_in_advanced_search' => false,
    'unique' => false
));

$installer->endSetup();
