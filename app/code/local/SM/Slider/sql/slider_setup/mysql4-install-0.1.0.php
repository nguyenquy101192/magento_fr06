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
    DROP TABLE IF EXISTS {$this->getTable('sm_slider_slider')};
    CREATE TABLE {$this->getTable('sm_slider_slider')} (
        `slider_id` int(10) unsigned auto_increment,
        `slider_name` varchar(200) NOT NULL default '',
        `slider_desc` text NULL default '',
        `slider_type` int(1) NOT NULL default '1',
        `slider_width` int(10) NULL,
        `slider_height` int(10) NULL,
        `slider_status` smallint(1) NOT NULL default '1',
        `store_view` varchar(100) NULL,
        `created_time` datetime NULL,
        `update_time` datetime NULL,
        PRIMARY KEY (`slider_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    DROP TABLE IF EXISTS {$this->getTable('sm_slider_image')};
    CREATE TABLE {$this->getTable('sm_slider_image')} (
        `image_id` int(10) unsigned auto_increment,
        `slider_id` int(10) NOT NULL,
        `image_name` varchar(200) NOT NULL,
        `image_caption` text NULL default '',
        `image_link` text NOT NULL,
        `image_status` smallint(1) NOT NULL default '1',
        `created_time` datetime NULL,
        `update_time` datetime NULL,
        PRIMARY KEY (`image_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
 