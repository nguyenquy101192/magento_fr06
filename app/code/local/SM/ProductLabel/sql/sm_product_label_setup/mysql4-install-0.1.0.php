<?php
/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/
$installer = $this;
$installer->startSetup();
$setup = Mage::getModel('core_setup');

$installer->run("
    DROP TABLE IF EXISTS {$this->getTable('sm_product_label')};
    CREATE TABLE {$this->getTable('sm_product_label')} (
        `label_id` int(10) unsigned auto_increment NOT NULL,
        `label_link` text NOT NULL,
        `label_name` text NOT NULL,
        `label_type` int(1) NULL,
        `status` int(1) NOT NULL,
        `created_time` datetime NULL,
        `update_time` datetime NULL,
        PRIMARY KEY (`label_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
 