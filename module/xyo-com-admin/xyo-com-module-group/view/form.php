<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$this->generateElement("row-begin");

$this->generateElement("panel-begin");
$this->generateElement("text", "name");
$this->generateElement("textarea", "description");
$this->generateElement("select", "enabled");
$this->generateElement("panel-end");

$this->generateElement("row-end");
