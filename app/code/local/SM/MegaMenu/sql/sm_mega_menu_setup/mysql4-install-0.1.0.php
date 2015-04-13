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
    DROP TABLE IF EXISTS {$this->getTable('sm_mega_menu_group')};
    CREATE TABLE {$this->getTable('sm_mega_menu_group')} (
        `group_id` int(10) unsigned auto_increment,
        `group_name` varchar(200) NOT NULL default '',
        `group_status` smallint(1) NOT NULL default '1',
        `group_type` int(1) NOT NULL,
        `position` int(1) NOT NULL,
        `store_view` int(1) NULL,
        `created_time` datetime NULL,
        `update_time` datetime NULL,
        PRIMARY KEY (`group_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    DROP TABLE IF EXISTS {$this->getTable('sm_mega_menu_items')};
    CREATE TABLE {$this->getTable('sm_mega_menu_items')} (
        `menu_id` int(10) unsigned auto_increment,
        `group_id` int(10) NOT NULL,
        `menu_name` varchar(200) NOT NULL default '',
        `menu_url` text NOT NULL,
        `menu_status` smallint(1) NOT NULL default '1',
        `menu_type` smallint(1) NOT NULL,
        `menu_type_item` varchar(100) NOT NULL,
        `show_by_tree` int(1) NOT NULL default'0',
        `parent_id` int(10) NOT NULL default '0',
        `level` int(10) NOT NULL default '1',
        `created_time` datetime NULL,
        `update_time` datetime NULL,
        PRIMARY KEY (`menu_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
 