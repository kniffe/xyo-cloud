<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$this->tableHead = array(
    "#" => "#",
    "name" => "head_name",
    "description" => "head_description",
    "default" => "head_default",
    "enabled" => "head_enabled",
    "id" => "head_id"
);

$this->tableSearch = array(
    "name" => true
);

$this->tableSelect = array(
    "enabled" => true
);

$this->tableType = array(
	"name" => array("cmd-edit"),
	"default"=>array("radio",array(
		"on"=>array(
			0=>$this->site."media/sys/images/favorite-off-16.png",
			1=>$this->site."media/sys/images/favorite-16.png"
		)
	)),
	"enabled"=>array("toggle")
);

$this->tableSort = array(
	"name" => "ascendent",
	"description" => "none",
	"enabled" => "none",
	"default" => "none",
	"id" => "none"
);

$this->processModel("select-enabled");

$this->tableSelectInfo = array(
	"default" => $this->getParameter("select_enabled", array()),
	"enabled" => $this->getParameter("select_enabled", array())
);

