<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$this->setReferenceBase($module, "xyo-mod-application");

$this->setDefaultComponent("xyo-app-install");
$this->setTemplate($module);
$this->setVersion($module, "2.0.0");
