<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$this->processModel("select-id");
$this->processModel("set-ds");
if ($this->isError()) {
    
} else {
    $this->processModel("package-uninstall");
}
$this->doRedirect("view");
