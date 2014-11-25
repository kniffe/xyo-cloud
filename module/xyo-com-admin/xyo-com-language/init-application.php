<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$this->setApplicationIcon($this->pathBase."media/sys/images/preferences-desktop-locale-48.png");
$this->setApplicationDataSource("db.table.xyo_language");
$this->setPrimaryKey("id");

$this->setDialogNew(true);
$this->setDialogEdit(true);

$this->requireElement(array(
	"select",
	"text",
	"textarea",
	"group-begin",
	"group-end",
	"group-row-begin",
	"group-row-end"
));
