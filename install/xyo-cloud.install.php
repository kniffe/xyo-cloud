<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');
defined('XYO_CLOUD_INSTALL') or die('Access is denied');
//
//$this->set("system_log_module",true);
//$this->set("system_log_request",true);
//$this->set("system_log_response",true);
//
$this->set("language", "en-GB");
if ($this->isRequest("website_language")) {
    if (strcmp($this->getRequest("website_language"), "-") != 0) {
        $this->set("language", $this->getRequest("website_language"));
    };
};
$this->set("system_datasource_layer", "xyo-mod-datasource-xyo");
$this->includeConfig("config.website");
//
$this->setModule(null, null, "xyo", true,null,false,true,false);
$this->setModule(null, null, "lib", true,null,false,true,false);
$this->setModule(null, null, "xyo-com", true,null,false,true,false);
//
$this->setModule("xyo", null, "xyo-mod-ds-db", true,null,false,true,false);
$this->setModule("xyo", null, "xyo-mod-datasource", true,null,false,true,false);
//
// default datasource drivers
//
$this->setModule("xyo", null, "xyo-mod-datasource-xyo", true,null,false,true,false);
$this->setModule("xyo", null, "xyo-mod-datasource-csv", true,null,false,true,false);
$this->setModule("xyo", null, "xyo-mod-datasource-sqlite", true,null,false,true,false);
$this->setModule("xyo", null, "xyo-mod-datasource-mysql", true,null,false,true,false);
$this->setModule("xyo", null, "xyo-mod-datasource-postgresql", true,null,false,true,false);
//
//
$this->setModule("xyo", null, "xyo-mod-htmlhead", true,null,false,true,false);
$this->setModule("xyo", null, "xyo-mod-htmlfooter", true,null,false,true,false);
//
$this->setModule("xyo", null, "xyo-mod-ds-acl", true,null,false,true,false);
$this->setModule("xyo", null, "xyo-mod-ds-user", true,null,false,true,false);
$this->setModule("xyo", null, "xyo-mod-language", true,null,false,true,false);
//
$this->setModule("lib", null, "lib-mod-jquery", true,null,false,true,false);
$this->setModule("lib", null, "lib-mod-bootstrap", true,null,false,true,false);
$this->setModule("lib", null, "lib-mod-bootstrap-feedback-left", true,null,false,true,false);
$this->setModule("lib", null, "lib-mod-bootstrap-select", true,null,false,true,false);
//
$this->setModule("xyo", null, "xyo-mod-application", true,null,false,true,false);
//
$this->setModule("xyo", null, "xyo-mod-ds-loader-ds", true,null,false,true,false);
//
$this->setModule("lib", null, "lib-mod-pear-archive-tar", true,null,false,true,false);
$this->setModule("xyo", null, "xyo-mod-setup", true,null,false,true,false);
$this->setModule("xyo-com", null, "xyo-mod-panel2", true,null,false,true,false);


$this->setModule(null, "install", "xyo-app-install", true, null, false,true,false);

$this->setModule("xyo-app-install", null, "xyo-tpl-install", true,null,false,true,false);
$this->setModuleGroup("xyo-tpl-install", "xyo-system-exec");
$this->setModuleAsComponent("xyo-app-install",true);
$this->setComponent("xyo-app-install");

