<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$this->language->includeFile("model/language/".strtolower($this->getSystemLanguage())."/select-enabled.php");

$select = array(
    "*" => $this->getFromLanguage("select_enabled_any"),
    "1" => $this->getFromLanguage("select_enabled_enabled"),
    "0" => $this->getFromLanguage("select_enabled_disabled")
);

$this->setParameter("select_enabled", $select);
