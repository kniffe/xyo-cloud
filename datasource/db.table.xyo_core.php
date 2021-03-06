<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$this->set("table_primary_key", "id");

$this->set("table_item", array(
		   "id" => array("bigint","DEFAULT","unsigned","auto_increment"),
		   "name" => array("varchar",64,null),
		   "description" => array("varchar",192,null),
		   "default" => array("int",0,"unsigned"),
		   "enabled" => array("int",0,"unsigned")
	   ));

$this->set("table_link",array(
		   "xyo_acl_module"=>array("db.table.xyo_acl_module","id_xyo_core","id","delete"),
		   "xyo_user_x_core"=>array("db.table.xyo_user_x_core","id_xyo_core","id","delete")
	   ));
